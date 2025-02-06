import React,{ useState, useEffect} from "react";
import {useForm,usePage} from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';


export default function Create({teachers}) { 
    const { flash } = usePage().props;
    const [showFlash, setShowFlash] = useState(true); // State สำหรับการแสดง flash message
    const { data, setData, post, errors } = useForm({ //ใช้ useform เพื่อจัดการข้อมูลในฟอร์ม
        first_name: '',                         //post ใช้ส่งข้อมูลไปหา controller,errors เก็บข้อความที่ผิดพลาดได้จากcontroller หลังตรวจสอบแล้ว
        last_name: '',
        major: '',
        phone: '',
        email: '',
        teacher_id: '',
    });

    console.log(flash); 

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('student.store' ));
    };

    useEffect(() => {
        if (flash.success || flash.error) {
            setTimeout(() => {
                setShowFlash(false); // ซ่อนข้อความหลังจาก 4 วินาที
            }, 4000); // 4000ms = 4 seconds
        }
        }, [flash]);

    return (
        <AuthenticatedLayout >
        {/* แสดงข้อความแจ้งเตือน */}
        {showFlash && flash?.success && (
            <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 w-full fixed top-0 left-0 z-10">
                {flash.success}
            </div>
        )}
        {showFlash && flash?.error && (
            <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 w-full fixed top-0 left-0 z-10">
                {flash.error}
            </div>
        )}
        <div className="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-8">
            <h2 className="text-2xl font-bold mb-4" style={{color: '#007bff' }}>Create Student</h2>
                
            <form onSubmit={handleSubmit}>
                
                {/* First Name */}
                <div className="mb-4">
                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="first_name">
                        First Name
                    </label>
                    <input
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text"
                        placeholder="Enter first name"
                        value={data.first_name}  //data คือข้อมูลที่มาจากตอนกรอกฟอร์มผ่านตัวแปร first_name 
                        onChange={(e) => setData('first_name', e.target.value)}
                    />
                    {errors.first_name && (<p className="text-red-500 text-sm">{errors.first_name}</p>)}
                </div>

                {/* Last Name */}
                <div className="mb-4">
                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="last_name">
                        Last Name
                    </label>
                    <input
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text"
                        placeholder="Enter last name"
                        value={data.last_name}
                        onChange={(e) => setData('last_name', e.target.value)}
                    />
                    {errors.last_name && (<p className="text-red-500 text-sm ">{errors.last_name}</p>)}
                </div>

                {/* Major */}
                <div className="mb-4">
                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="major">
                        Major
                    </label>
                    <input
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text"
                        placeholder="Enter major"
                        value={data.major}
                        onChange={(e) => setData('major', e.target.value)}
                    />
                    {errors.major && (<p className="text-red-500 text-sm ">{errors.major}</p>)}
                </div>

                {/* Phone Number */}
                <div className="mb-4">
                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="phone">
                        Phone Number
                    </label>
                    <input
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text"
                        placeholder="Enter phone number"
                        value={data.phone}
                        onChange={(e) => setData('phone', e.target.value)}
                    />
                    {errors.phone && (<p className="text-red-500 text-sm">{errors.phone}</p>)}
                </div>
                
                {/* Email */}
                <div className="mb-4">
                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="email">
                        Email
                    </label>
                    <input
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text"
                        placeholder="Enter email"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                    />
                    {errors.email && (<p className="text-red-500 text-sm ">{errors.email}</p>)}
                </div>


                {/* Teacher ID */}
                <div className="mb-4">
                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="teacher_id">
                    Teacher Advisor
                    </label>
                    <select
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value={data.teacher_id}
                        onChange={(e) => setData('teacher_id', e.target.value)}
                        
                    >
                        <option value="">Select Teacher Advisor</option>
                        {teachers.map((teacher) => (
                            <option key={teacher.teacher_id} value={teacher.teacher_id}> 
                                {teacher.first_name} {teacher.last_name} ({teacher.teacher_id})
                            </option>
                        ))}
                    </select>
                    {errors.teacher_id && (<p className="text-red-500 text-sm">{errors.teacher_id}</p>)}
                </div>

                {/* Submit Button */}
                <div className="flex items-center justify-between">
                    <button
                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Add Student
                    </button>
                    <a href="/students" className="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
    );
}