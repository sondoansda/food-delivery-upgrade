import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { format } from 'date-fns';
import 'bootstrap/dist/css/bootstrap.min.css';

const RestaurantPage = () => {
  const [restaurants, setRestaurants] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [page, setPage] = useState(1);

  useEffect(() => {
    setLoading(true);
    axios
      .get(`http://localhost:8080/food-delivery-app1/public/api/restaurants?page=${page}`)
      .then((res) => {
        setRestaurants(res.data.data);
        setLoading(false);
        setError(null);
      })
      .catch((err) => {
        setLoading(false);
        setError('Không tải được danh sách nhà hàng. Vui lòng thử lại sau!');
      });
  }, [page]);

  const handleNextPage = () => setPage((prevPage) => prevPage + 1);
  const handlePreviousPage = () => page > 1 && setPage((prevPage) => prevPage - 1);

  return (
    <div className="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="mb-8 text-center">
          <h3 className="text-3xl font-bold text-gray-900 tracking-tight">
            Gợi Ý Hàng Đầu Cho Bạn
          </h3>
          <p className="mt-2 text-gray-600 text-lg">
            Khám phá những địa điểm ăn uống tuyệt vời được chọn lọc 🍴
          </p>
        </div>

        {loading ? (
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            {[...Array(4)].map((_, index) => (
              <div
                key={index}
                className="bg-white rounded-2xl shadow-lg p-5 animate-pulse"
              >
                <div className="h-32 bg-gray-300 rounded-t-2xl mb-3"></div>
                <div className="h-6 bg-gray-300 rounded w-3/4 mb-2"></div>
                <div className="h-4 bg-gray-300 rounded w-1/2 mb-1"></div>
                <div className="h-4 bg-gray-300 rounded w-2/3"></div>
              </div>
            ))}
          </div>
        ) : error ? (
          <div className="bg-red-50 p-8 rounded-2xl shadow-lg text-center text-red-600">
            {error}
          </div>
        ) : restaurants.length === 0 ? (
          <div className="bg-white p-8 rounded-2xl shadow-lg text-center text-gray-600">
            😔 Không tìm thấy nhà hàng nào.
          </div>
        ) : (
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            {restaurants.map((restaurant) => (
              <div
                key={restaurant.id}
                className="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 min-h-[200px]"
              >
                <div className="p-5">
                  {restaurant.image ? (
                    <img
                      src={restaurant.image}
                      alt={restaurant.name}
                      className="w-full h-32 object-cover rounded-t-2xl"
                    />
                  ) : (
                    <div className="w-full h-32 bg-gray-200 rounded-t-2xl flex items-center justify-center">
                      <span className="text-gray-500">No Image</span>
                    </div>
                  )}
                  <h4 className="text-xl font-bold text-gray-900 truncate mt-3">
                    {restaurant.name || 'Chưa có tên'}
                  </h4>
                  <p className="text-sm text-gray-500 mt-1 flex items-center truncate">
                    <span className="mr-1">📍</span>
                    {restaurant.address || 'Không có địa chỉ'}
                  </p>
                  <p className="text-sm text-gray-500 mt-1 flex items-center truncate">
                    <span className="mr-1">📞</span>
                    {restaurant.phone || 'Không có số điện thoại'}
                  </p>
                  <a
                    href={`/restaurants/${restaurant.id}`}
                    className="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors duration-200"
                  >
                    Xem chi tiết →
                  </a>
                  <div className="mt-3 text-xs text-gray-500">
                    <p>
                      Ngày tạo:{' '}
                      {restaurant.created_at
                        ? format(new Date(restaurant.created_at), 'dd/MM/yyyy HH:mm:ss')
                        : 'Không có ngày tạo'}
                    </p>
                    <p>
                      Cập nhật lần cuối:{' '}
                      {restaurant.updated_at
                        ? format(new Date(restaurant.updated_at), 'dd/MM/yyyy HH:mm:ss')
                        : 'Không có thông tin cập nhật'}
                    </p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}

        {restaurants.length > 0 && (
          <div className="mt-12 flex justify-center items-center space-x-4">
            <button
              onClick={handlePreviousPage}
              disabled={page === 1}
              className="px-5 py-2 bg-indigo-600 text-white rounded-full font-medium hover:bg-indigo-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors duration-200"
            >
              Trước
            </button>
            <span className="text-gray-700 font-medium">Trang {page}</span>
            <button
              onClick={handleNextPage}
              className="px-5 py-2 bg-indigo-600 text-white rounded-full font-medium hover:bg-indigo-700 transition-colors duration-200"
            >
              Tiếp
            </button>
          </div>
        )}
      </div>
    </div>
  );
};

export default RestaurantPage;