import React,{ useState, useEffect} from "react";
import { Inertia } from "@inertiajs/inertia";
import {usePage } from "@inertiajs/react";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import './Index.css';

export default function Index({ students }) {
        const headers = ['Student ID', 'Name', 'Major', 'Phone Number', 'Email', 'Teacher Advisor','More Action']; 
        const [openMenu, setOpenMenu] = useState(null);
       
        const { flash } = usePage().props;
        const [showFlash, setShowFlash] = useState(true); // State สำหรับการแสดง flash message
        const handleDelete = (student_id) => {
                if (confirm("Are you sure you want to delete this student's info?")) 
                        { Inertia.delete(`/students/${student_id}`);}
                };

        useEffect(() => {
        if (flash.success || flash.error) {
            setTimeout(() => {
                setShowFlash(false); // ซ่อนข้อความหลังจาก 4 วินาที
            }, 4000); // 4000ms = 4 seconds
        }
        }, [flash]);
                        
    return (
        
        <AuthenticatedLayout>
        {showFlash && flash?.success && (
            <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-full fixed top-0 left-0 z-10" style={{ marginBottom: 0 }}>
                {flash.success}
            </div>
        )}
        {showFlash && flash?.error && (
            <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative  w-full fixed top-0 left-0 z-10" style={{ marginBottom: 0 }}>
                {flash.error}
            </div>
        )}
        <div style={{ maxWidth: "1550px", margin: "0 auto", border: '1px solid #ddd', borderRadius: '8px', boxShadow: '0 2px 5px rgba(0,0,0,0.1)' }}>
            <h1 style={{ fontSize: '2.3em', fontWeight: 'bold', textAlign: 'center', margin: '40px 50px', color: '#007bff' }}>Students</h1>
            <div style={{ height: "645px", overflowY: "auto", marginBottom: '50px' }}>
            <table style={{width: "100%",borderCollapse: "collapse",marginBottom: '50px'}}>
                <thead style={{ backgroundColor: "#f8f9fa" }}>
                <tr>
                    {headers.map((header, index) => (
                        <th key={index} style={{padding: '10px 20px',textAlign: 'center',borderBottom: '1px solid #ddd',fontWeight: "bold"}}>
                            {header}
                        </th>
                    ))}
                </tr>
                </thead>
                <tbody>
                    {students.data.map((student, index) => (
                        <tr key={student.student_id} style={{ backgroundColor: index % 2 === 0 ? "#f8f9fa" : "#fff" }}>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.student_id}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.first_name}&nbsp;&nbsp;{student.last_name}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.major}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.phone}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.email}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>
                                {student.teacher.first_name}&nbsp;&nbsp;{student.teacher.last_name} </td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center', position: 'relative' }}>
                                <button onClick={() => setOpenMenu(openMenu === student.student_id ? null : student.student_id)}
                                     style={{
                                        background: 'none',
                                        border: 'none',
                                        fontSize: '20px',
                                        cursor: 'pointer'
                                    }}
                                >
                                    &#x22EE;
                                </button>

                                {openMenu === student.student_id && (
                                    <div style={{
                                        position: 'absolute',
                                        right: '10px',
                                        top: '30px',
                                        background: '#fff',
                                        border: '1px solid #ddd',
                                        borderRadius: '5px',
                                        boxShadow: '0 2px 5px rgba(0,0,0,0.2)',
                                        zIndex: 10
                                        }}>
                                
                                        <button onClick={() => Inertia.visit(`/students/${student.student_id}/edit`)} className="menu-item">
                                            Edit
                                        </button>
                                        <button onClick={() => handleDelete(student.student_id) } className="menu-item">
                                            Delete
                                        </button>
                                    </div>
                                )}
                            </td>
                      </tr>
                    ))}
                </tbody>
            </table>

            {/* Pagination Controls */}
            <div style={{ display: "flex", justifyContent: "center", marginTop: "20px" }}>
                <button
                    onClick={() => students.prev_page_url && Inertia.visit(students.prev_page_url)}
                    disabled={!students.prev_page_url}
                    style={{
                        margin: "0 5px",
                        padding: "8px 12px",
                        backgroundColor: students.prev_page_url ? "#007bff" : "#fff",
                        color: students.prev_page_url ? "#fff" : "#007bff",
                        border: "1px solid #ddd",
                        borderRadius: "5px",
                        cursor: students.prev_page_url ? "pointer" : "not-allowed",
                        opacity: students.prev_page_url ? 1 : 0.5,
                    }}
                >
                    &laquo; Previous
                </button>

                {(() => {
                    const currentPage = students.current_page;
                    const lastPage = students.last_page;
                    const pageNumbers = [];

                            for (let i = 1; i <= 3; i++) {
                                if (i > lastPage) break;
                                pageNumbers.push(i);
                            }

                            if (currentPage > 4) {
                                pageNumbers.push('...');
                            }

                            for (let i = Math.max(1, currentPage - 1); i <= Math.min(lastPage, currentPage + 1); i++) {
                                if (i > 3 && i < lastPage - 2) {
                                    pageNumbers.push(i);
                                }
                            }

                            if (currentPage < lastPage - 3) {
                                pageNumbers.push('...');
                            }

                            for (let i = lastPage - 2; i <= lastPage; i++) {
                                if (i > 3 && i <= lastPage) {
                                    pageNumbers.push(i);
                                }
                            }

                    return Array.from(pageNumbers).map((page, index) => (
                        <button
                            key={index}
                            onClick={() => typeof page === 'number' && Inertia.visit(`${students.path}?page=${page}`)}
                            style={{
                                margin: "0 5px",
                                padding: "8px 12px",
                                backgroundColor: page === currentPage ? "#007bff" : "#fff",
                                color: page === currentPage ? "#fff" : "#007bff",
                                border: "1px solid #ddd",
                                borderRadius: "5px",
                                cursor: page === "..." ? "not-allowed" : "pointer",
                            }}
                        >
                            {page}
                        </button>
                    ));
                })()}

                <button
                    onClick={() => students.next_page_url && Inertia.visit(students.next_page_url)}
                    disabled={!students.next_page_url}
                    style={{
                        margin: "0 5px",
                        padding: "8px 12px",
                        backgroundColor: students.next_page_url ? "#007bff" : "#fff",
                        color: students.next_page_url ? "#fff" : "#007bff",
                        border: "1px solid #ddd",
                        borderRadius: "5px",
                        cursor: students.next_page_url ? "pointer" : "not-allowed",
                        opacity: students.next_page_url ? 1 : 0.5,
                    }}
                >
                    Next &raquo;
                </button>
            
            </div>
            </div>   
        </div>
        </AuthenticatedLayout>
        
    );
    
};



