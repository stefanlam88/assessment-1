<template>
     <div class="flex justify-center w-full align-center">
        <form @submit.prevent="login">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input
                        class="w-full px-3 py-2 my-2  border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                        type="text"
                        v-model="email"
                        placeholder="Email address"
                    />
                
                </div>
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    class="w-full px-3 py-2 my-2 border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                    type="password"
                    v-model="password"
                    placeholder="Enter Password"
                />
            </div>
            <button type="submit" class="w-full mt-6 px-6 py-2 font-semibold text-white rounded-md hover:opacity-90 transition-all duration-500 ease-in-out focus:outline-none bg-blue-600">Login</button>
        </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { useCart } from "../store/useCart";
  import { reactive } from "vue";
   
  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
    methods: {
      async login() {
        try {
          const response = await axios.post('/api/login', {
            email: this.email,
            password: this.password
          });

          const store = useCart();
          // Store user session data in local storage upon successful login
          localStorage.setItem('isLoggedIn', true);
          localStorage.setItem('user', JSON.stringify(response.data.user));
          localStorage.setItem('token', JSON.stringify(response.data.token));
          console.log(JSON.stringify(response.data.user))
          const formData = reactive({
            firstName: response.data.user.name,
            lastName: "",
            address: response.data.user.address,
            zipcode: response.data.user.zipcode,
            city: response.data.user.city,
            state: response.data.user.state,
            email: response.data.user.email,
          });

          store.saveCustomerDetails(formData);

          window.location.href = '/';
          // Redirect to home page or perform any other action
        } catch (error) {
          console.error(error.response.data);
          // Handle login error
        }
      }
    }
  };
  </script>