import React, { useEffect, useState } from 'react';
import axios from 'axios';

const AttendanceList = () => {
  const [attendance, setAttendance] = useState([]);

  useEffect(() => {
    fetchAttendance();
  }, []);

  const fetchAttendance = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/attendance/123');
      alert(response.data);
      setAttendance(response.data);
    } catch (error) {
        alert(error);
      console.error(error);
    }
  };

  return (
    <div>
      <h2>Attendance List</h2>
      <table>
        <thead>
          <tr>
            <th>Employee ID</th>
            <th>Check In</th>
            <th>Check Out</th>
          </tr>
        </thead>
        <tbody>
          {attendance.map((record) => (
            <tr key={record.id}>
              <td>{record.employee_id}</td>
              <td>{record.check_in || 'N/A'}</td>
              <td>{record.check_out || 'N/A'}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default AttendanceList;