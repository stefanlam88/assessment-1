<template>
    <div class=" justify-center w-full align-center">
        <LoadingModal :isLoading="loading" />
       <form @submit.prevent="register">
            <div class="col-md-12 mb-3">
               <label for="password" class="form-label">Full name</label>
               <input
                   class="w-full px-3 py-2 my-2 border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                   type="text"
                   v-model="name"
                   placeholder="Enter Full Name"
               />
               <span v-if="formErrors.name" class="error text-red">{{ formErrors.name }}</span>

           </div>
           <div class="row">
               <div class="col-md-12 mb-3">
                   <label for="email" class="form-label">Email address</label>
                   <input
                       class="w-full px-3 py-2 my-2  border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                       type="text"
                       v-model="email"
                       placeholder="Email address"
                   />
                   <span v-if="formErrors.email" class="error text-red">{{ formErrors.email }}</span>
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
               <span v-if="formErrors.password" class="error text-red">{{ formErrors.password }}</span>
           </div>

           <div class="col-md-12 mb-3">
               <label for="password" class="form-label">Confirm Password</label>
               <input
                   class="w-full px-3 py-2 my-2 border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                   type="password"
                   v-model="confirm_password"
                   placeholder="Enter Password"
               />
               <span v-if="formErrors.password" class="error text-red">{{ formErrors.password }}</span>
           </div>

           <div class="row">
               <div class="col-md-12 mb-3">
                   <label for="email" class="form-label">Address</label>
                   <input
                       class="w-full px-3 py-2 my-2  border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                       type="text"
                       v-model="address"
                       placeholder="Email address"
                   />
                   <span v-if="formErrors.address" class="error text-red">{{ formErrors.address }}</span>
               </div>
           </div>

           <div class="row">
               <div class="col-md-12 mb-3">
                   <label for="email" class="form-label">State</label>
                   <input
                       class="w-full px-3 py-2 my-2  border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                       type="text"
                       v-model="state"
                       placeholder="State"
                   />
                   <span v-if="formErrors.state" class="error text-red">{{ formErrors.state }}</span>
               </div>
           </div>

           <div class="row">
               <div class="col-md-12 mb-3">
                   <label for="email" class="form-label">City</label>
                   <input
                       class="w-full px-3 py-2 my-2  border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                       type="text"
                       v-model="city"
                       placeholder="City"
                   />
                   <span v-if="formErrors.city" class="error text-red">{{ formErrors.city }}</span>
               
               </div>
           </div>

           <div class="row">
               <div class="col-md-12 mb-3">
                   <label for="email" class="form-label">Zip Code</label>
                   <input
                       class="w-full px-3 py-2 my-2  border-2 border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none transition-all duration-300"
                       type="text"
                       v-model="zipcode"
                       placeholder="Zip Code"
                   />
                   <span v-if="formErrors.zipcode" class="error text-red">{{ formErrors.zipcode }}</span>
               
               </div>
           </div>
           <button type="submit" class="w-full mt-6 px-6 py-2 font-semibold text-white rounded-md hover:opacity-90 transition-all duration-500 ease-in-out focus:outline-none bg-blue-600">Register</button>
          
        </form>
   </div>
 </template>
 
 <style>
.text-red{
    color:red;
}
</style>
 <script>
 import axios from 'axios';
 import { useCart } from "../store/useCart";
 import { reactive } from "vue";
 import Loading from '../components/base/Loading.vue';
  
 export default {
   data() {
     return {
       loading: true,
       email: '',
       password: '',
       confirm_password: '',
       name: '',
       zipcode: '',
       state: '',
       address: '',
       city: '',
       formErrors: {}
     };
   },
   methods: {
    loadData() {
      this.loading = true;

      // Simulate loading data (replace with your actual data loading logic)
      setTimeout(() => {
        this.loading = false;
      }, 3000);
    },
     async register() {
        this.formErrors = {};
        this.loadData();
       try {
         const response = await axios.post('/api/register', {
           email: this.email,
           password: this.password,
           password_confirmation : this.confirm_password,
           name: this.name,
           city: this.city,
           address: this.address,
           state: this.state,
           zipcode: this.zipcode
         });

        //  const store = useCart();
        //  // Store user session data in local storage upon successful login
        //  localStorage.setItem('isLoggedIn', true);
        //  localStorage.setItem('user', JSON.stringify(response.data.user));
        //  localStorage.setItem('token', JSON.stringify(response.data.token));
        //  console.log(JSON.stringify(response.data.user))
        //  const formData = reactive({
        //    firstName: response.data.user.name,
        //    lastName: "",
        //    address: response.data.user.address,
        //    zipcode: response.data.user.zipcode,
        //    city: response.data.user.city,
        //    state: response.data.user.state,
        //    email: response.data.user.email,
        //  });

        //  store.saveCustomerDetails(formData);

         window.location.href = '/#/login';
         // Redirect to home page or perform any other action
       } catch (error) {
         console.error(error.response.data);
         if(error.response.data.errors['name'] != null){
            this.formErrors.name = error.response.data.errors['name'][0];
         }
         if(error.response.data.errors['email'] != null){
            this.formErrors.email = error.response.data.errors['email'][0];
         }
         if(error.response.data.errors['password'] != null){
            this.formErrors.password = error.response.data.errors['password'][0];
         }
         if(error.response.data.errors['address'] != null){
            this.formErrors.address = error.response.data.errors['address'][0];
         }
         if(error.response.data.errors['city'] != null){
            this.formErrors.city = error.response.data.errors['city'][0];
         }
         if(error.response.data.errors['state'] != null){
            this.formErrors.state = error.response.data.errors['state'][0];
         }
         if(error.response.data.errors['zipcode'] != null){
            this.formErrors.zipcode = error.response.data.errors['zipcode'][0];
         }
         // Handle login error
       }
     }
   }
 };
 </script>