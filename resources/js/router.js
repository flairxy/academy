import VueRouter from "vue-router"
import UserDashboard from "./views/user/Dashboard"
import AdminDashboard from "./views/admin/Dashboard"
import UserCourse from "./views/user/VideoCourse"
import UserMyCourse from "./views/user/MyCourses"
import Profile from "./views/user/Profile"
import Courses from "./views/admin/Courses"
import Categories from "./views/admin/Settings"
import Gallery from "./views/admin/Gallery"
import Contents from "./views/admin/Contents"
import Users from "./views/admin/Users"
import Error from "./views/Error_404"

export let routes = [
           // admin routes
           { path: "/management/dashboard", name: "admin-dashboard", component: AdminDashboard },
           { path: "/management/users", name: "users", component: Users },
           { path: "/management/courses", name: "courses", component: Courses },
           { path: "/management/contents", name: "contents", component: Contents },
           { path: "/management/categories", name: "settings", component: Categories },
           { path: "/management/gallery", name: "gallery", component: Gallery },

           // user routes
           { path: "/dashboard", name: "user-dashboard", component: UserDashboard },
           { path: "/my/courses", name: "my-courses", component: UserMyCourse },
           { path: "/my/profile", name: "my-profile", component: Profile },
           { path: "/course/:id", name: "user-course", component: UserCourse },

           //general route
           { path: "*", name: "/error", component: Error }
       ]
