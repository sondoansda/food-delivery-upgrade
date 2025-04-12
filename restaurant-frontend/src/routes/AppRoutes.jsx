import React from 'react';
import { Routes, Route } from 'react-router-dom';

import RestaurantPage from '../pages/RestaurantPage';

function AppRoutes() {
  return (
    <Routes>
      <Route path="/restaurants" element={<RestaurantPage/>} />
      {/* <Route path="/restaurant/:id" element={<RestaurantDetailPage />} /> */}
    </Routes>
  );
}

export default AppRoutes;
