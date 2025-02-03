import React from "react";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Index({ students }) {
    const headers = ['Student ID', 'Firstname', 'Lastname','Major', 'Phone', 'Email']; 

    return (
        
        <AuthenticatedLayout>
        <div style={{ maxWidth: "1500px", margin: "0 auto", padding: "20px", border: '1px solid #ddd', borderRadius: '8px', boxShadow: '0 2px 5px rgba(0,0,0,0.1)' }}>
            <h1 style={{ fontSize: '2.3em', fontWeight: 'bold', textAlign: 'center', margin: '40px 50px', color: '#007bff' }}>Students</h1>

            <table style={{width: "100%",borderCollapse: "collapse",marginBottom: '50px'}}>
                <thead style={{ backgroundColor: "#f8f9fa" }}>
                <tr>
                    {headers.map((header, index) => (
                        <th key={index} style={{
                            padding: '10px 20px',
                            textAlign: 'center',
                            borderBottom: '1px solid #ddd',
                            fontWeight: "bold"
                        }}>
                            {header}
                        </th>
                    ))}
                </tr>
                </thead>
                <tbody>
                    {students.data.map((student, index) => (
                        <tr key={student.student_id} style={{ backgroundColor: index % 2 === 0 ? "#f8f9fa" : "#fff" }}>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.student_id}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.first_name}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.last_name}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.major}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.phone}</td>
                            <td style={{ padding: '10px 20px', borderBottom: "1px solid #ddd", textAlign: 'center' }}>{student.email}</td>
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
                    const pageNumbers = new Set();

                    for (let i = 1; i <= 3; i++) {
                        if (i <= lastPage) pageNumbers.add(i);
                    }

                    for (let i = Math.max(1, currentPage - 1); i <= Math.min(lastPage, currentPage + 1); i++) {
                        pageNumbers.add(i);
                    }

                    if (currentPage < lastPage - 3) {
                        pageNumbers.add('...');
                    }

                    for (let i = lastPage - 2; i <= lastPage; i++) {
                        if (i > 3 && i <= lastPage) {
                            pageNumbers.add(i);
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
        </AuthenticatedLayout>
        
    );
    
};



