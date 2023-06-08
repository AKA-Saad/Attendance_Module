import React, { useEffect, useState } from 'react';
import {useStateContext} from "../context/ContextProvider";
import axios from 'axios';

const AttendanceList = () => {
  const [attendance, setAttendance] = useState([]);
  const {user} = useStateContext();
  console.log(useState([]));
  
  useEffect(() => {
    fetchAttendance();
  }, []);


  const fetchAttendance = async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/attendance/${user.id}`);
      setAttendance(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <h2>Attendance List  </h2>
      <table>
        <thead>
          <tr>
            <th>Employee ID</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th> Total Working Hours</th>
          </tr>
        </thead>
        <tbody>
          {attendance.length === 0 ? (
            <tr>
              <td colSpan="4">No attendance data available</td>
            </tr>
          ) : (
            attendance.map((record) => (
              <tr key={record.id}>
                <td>{record.employee_id}</td>
                <td>{record.check_in || 'N/A'}</td>
                <td>{record.check_out || 'N/A'}</td>
                <td>{'logic' || 'N/A'}</td>
              </tr>
            ))
          )}
        </tbody>
      </table>
    </div>
  );
};

export default AttendanceList;