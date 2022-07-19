import axios from 'axios'


export default axios.create({
    baseURL: 'http://laravel-todo.test',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }
})
