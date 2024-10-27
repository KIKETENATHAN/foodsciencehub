import React from 'react';
import { Home, User, Bell, MessageCircle, Calendar, Users, Map, Plus, Search } from 'lucide-react';

const DashboardLayout = () => {
  return (
    <div className="min-h-screen bg-gray-50">
      {/* Top Navigation Bar */}
      <nav className="bg-white shadow-sm px-4 py-2 flex items-center justify-between fixed w-full top-0 z-10">
        <div className="flex items-center">
          <div className="text-red-500 text-2xl font-bold mr-2">
            {/* Logo placeholder */}
            <span className="flex items-center">
              <div className="w-8 h-8 bg-red-500 rounded-lg mr-2"></div>
              CampoPrime
            </span>
          </div>
        </div>
        
        <div className="flex items-center space-x-4">
          <button className="p-2 hover:bg-gray-100 rounded-full">
            <Bell size={20} />
          </button>
          <button className="p-2 hover:bg-gray-100 rounded-full">
            <MessageCircle size={20} />
          </button>
          <button className="p-2 hover:bg-gray-100 rounded-full">
            <Search size={20} />
          </button>
          <div className="w-8 h-8 bg-gray-300 rounded-full"></div>
        </div>
      </nav>

      {/* Sidebar */}
      <aside className="fixed left-0 top-0 pt-16 h-full w-64 bg-white border-r border-gray-200">
        <div className="p-4">
          <div className="text-gray-500 text-sm font-semibold mb-4">GENERAL</div>
          <nav className="space-y-2">
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <Home size={20} />
              <span>Home</span>
            </a>
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <User size={20} />
              <span>Profile</span>
            </a>
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <Bell size={20} />
              <span>Notifications</span>
              <span className="ml-auto bg-gray-100 text-gray-600 text-xs px-2 rounded-full">0</span>
            </a>
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <MessageCircle size={20} />
              <span>Chats</span>
            </a>
          </nav>

          <div className="text-gray-500 text-sm font-semibold mt-8 mb-4">FROM SCHOOL</div>
          <nav className="space-y-2">
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <Calendar size={20} />
              <span>Events & noticeboards</span>
            </a>
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <Calendar size={20} />
              <span>My Calendar</span>
            </a>
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <Users size={20} />
              <span>Clubs & Communities</span>
            </a>
          </nav>

          <div className="text-gray-500 text-sm font-semibold mt-8 mb-4">DOCS</div>
          <nav className="space-y-2">
            <a href="#" className="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
              <Map size={20} />
              <span>Roadmap</span>
            </a>
          </nav>
        </div>

        <div className="absolute bottom-4 left-4 text-sm text-gray-500">
          Made with ❤️ by Campoprime Labs®. ©2024.
        </div>
      </aside>

      {/* Main Content */}
      <main className="ml-64 pt-16 p-6">
        {/* Tabs */}
        <div className="mb-8">
          <div className="border-b border-gray-200">
            <div className="flex space-x-8">
              <button className="border-b-2 border-blue-500 px-4 py-2 text-blue-600 font-medium">
                Global Community
              </button>
              <button className="px-4 py-2 text-gray-500 font-medium hover:text-gray-700">
                My School
              </button>
            </div>
          </div>
        </div>

        {/* Create Post Button */}
        <div className="flex justify-end mb-8">
          <button className="flex items-center space-x-2 px-4 py-2 border border-red-500 text-red-500 rounded-full hover:bg-red-50">
            <Plus size={20} />
            <span>Create Post</span>
          </button>
        </div>

        {/* Community Events Section */}
        <div className="bg-white rounded-lg shadow-sm p-6 mb-8">
          <h2 className="text-xl font-semibold mb-4">Community Events & Notices</h2>
          <div className="flex space-x-4 mb-4">
            <button className="bg-blue-500 text-white px-4 py-2 rounded-lg">
              Noticeboard
            </button>
            <button className="text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">
              Events
            </button>
          </div>
          <div className="text-gray-500 text-center py-8">
            Noticeboard is empty.
          </div>
        </div>

        {/* Suggested Users Section */}
        <div className="mb-8">
          <div className="flex justify-between items-center mb-4">
            <h2 className="text-xl font-semibold">Suggested For You</h2>
            <button className="text-gray-600 hover:text-gray-800">See All</button>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {['Mercy Kantai', 'Kenneth Irungu', 'Mercy Kantai', 'Cecily M'].map((name, index) => (
              <div key={index} className="bg-white rounded-lg shadow-sm p-4">
                <div className="flex items-center space-x-3 mb-4">
                  <div className="w-12 h-12 bg-gray-200 rounded-full"></div>
                  <div>
                    <div className="font-medium">{name}</div>
                    <div className="text-sm text-gray-500">Campoprime University</div>
                  </div>
                </div>
                <button className="w-full px-4 py-2 border border-blue-500 text-blue-500 rounded-lg hover:bg-blue-50">
                  Follow
                </button>
              </div>
            ))}
          </div>
        </div>

        {/* Bottom Navigation */}
        <div className="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 md:hidden">
          <div className="flex justify-around p-4">
            <button className="flex flex-col items-center text-gray-500">
              <Home size={20} />
              <span className="text-xs mt-1">StudyPro</span>
            </button>
            <button className="flex flex-col items-center text-gray-500">
              <Home size={20} />
              <span className="text-xs mt-1">Discover</span>
            </button>
            <button className="flex flex-col items-center text-gray-500">
              <MessageCircle size={20} />
              <span className="text-xs mt-1">Kejapair</span>
            </button>
            <button className="flex flex-col items-center text-gray-500">
              <Bell size={20} />
              <span className="text-xs mt-1">Bytes</span>
            </button>
            <button className="flex flex-col items-center text-gray-500">
              <User size={20} />
              <span className="text-xs mt-1">Profile</span>
            </button>
          </div>
        </div>
      </main>
    </div>
  );
};

export default DashboardLayout;