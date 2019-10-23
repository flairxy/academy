import axios from "axios"
axios.interceptors.request.use(
    (config) => {
        let token = localStorage.getItem('token');

        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`
        }
        return config
    },

    (error) => {
        return Promise.reject(error)
    }
)

const adminContent = "/api/admin/content"
const adminCourse = "/api/admin/course"
const adminCategory = "/api/admin/category"
const adminUser = "/api/admin/user"
const user = "/api/user"
export default {
    loggedInUser() {
        return axios.get(`/api/user`)
    },
    getMyCourses(id) {
        return axios.get(`${adminCourse}/user/${id}/courses`)
    },
    getCourses() {
        return axios.get(`${adminCourse}/index`)
    },
    createCourse(data) {
        return axios.post(`${adminCourse}/create`, data)
    },
    updateCourse(data, id) {
        return axios.post(`${adminCourse}/${id}/update`, data)
    },
    deleteCourse(id) {
        return axios.post(`${adminCourse}/${id}/delete`)
    },

    getContents() {
        return axios.get(`${adminContent}/index`)
    },
    getCourseContents(course_id, user_id) {
        return axios.get(`${adminContent}/${user_id}/contents/${course_id}`)
    },
    createContent(data) {
        return axios.post(`${adminContent}/create`, data)
    },
    updateContent(data, id) {
        return axios.post(`${adminContent}/${id}/update`, data)
    },
    deleteContent(id) {
        return axios.post(`${adminContent}/${id}/delete`)
    },
    deleteFile(id) {
        return axios.post(`${adminContent}/file/${id}/delete`)
    },
    getImages() {
        return axios.post(`${adminContent}/file/images`)
    },
    uploadFiles(data) {
        return axios.post(`${adminContent}/file/upload`, data)
    },

    deleteSubscription(id) {
        return axios.post(`${adminUser}/${id}/subscription/delete`)
    },
    getAllSubs() {
        return axios.get(`${adminUser}/subscriptions`)
    },
    getUser(id) {
        return axios.get(`${adminUser}/${id}/user`)
    },
    getUsers() {
        return axios.get(`${adminUser}/index`)
    },
    updateUser(data, id) {
        return axios.post(`${adminUser}/${id}/update`, data)
    },
    deleteUser(id) {
        return axios.post(`${adminUser}/${id}/delete`)
    },
    paypalPayment(data) {
        return axios.post(`/api/admin/paypal/checkout`, data)
    },

    getCategories() {
        return axios.get(`${adminCategory}/index`)
    },
    createCategory(data) {
        return axios.post(`${adminCategory}/create`, data)
    },
    updateCategory(data, id) {
        return axios.post(`${adminCategory}/${id}/update`, data)
    },
    deleteCategory(id) {
        return axios.post(`${adminCategory}/${id}/delete`)
    },

    updateProfile(data, id) {
        return axios.post(`${user}/${id}/update`, data)
    },

    updatePassword(data, id) {
        return axios.post(`${user}/${id}/password/update`, data)
    },
    viewProfile() {
        return axios.get(`${user}/index`)
    },
    getSubs(id) {
        return axios.get(`${user}/${id}/subscriptions`)
    }
}
