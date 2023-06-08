import React, { useEffect, useState } from 'react';
import axiosClient from "../axios-client.js";
import { useStateContext } from "../context/ContextProvider";

import axios from 'axios';

const AttendanceList = () => {
  const [attendance, setAttendance] = useState([]);

  const { user, setUser } = useStateContext();

  useEffect(() => {
    axiosClient.get('/user')
      .then(({ data }) => {
        setUser(data);
        fetchAttendance(data.id);
      })
  }, [])

  const fetchAttendance = async (id) => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/attendance/${id}`);
      console.log(response.data);
      setAttendance(response.data);
    } catch (error) {
      console.error(error);
    }
  };



  return (
    <div>
      <h2>Attendance List</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
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
            attendance.map((record) => {
              const checkin = record.checkin || 'N/A';
              const checkout = record.checkout || 'N/A';

              let totalWorkingHours = 'N/A';
              if (checkin !== 'N/A' && checkout !== 'N/A') {
                const checkinDate = new Date(checkin);
                const checkoutDate = new Date(checkout);
                const timeDiff = Math.abs(checkoutDate - checkinDate);
                totalWorkingHours = Math.floor(timeDiff / (1000 * 60 * 60));
              }

              return (
                <tr key={record.id}>
                  <td>{user.name}</td>
                  <td>{checkin}</td>
                  <td>{checkout}</td>
                  <td>{totalWorkingHours !== 'N/A' ? `${totalWorkingHours} hours` : 'N/A'}</td>
                </tr>
              );
            })

          )}
        </tbody>
      </table>
    </div>
  );
};

export default AttendanceList;