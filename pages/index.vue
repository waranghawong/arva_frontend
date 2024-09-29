<script lang="ts" setup>
import MainLayout from './layout/MainLayout.vue'
import AppLogo from './assets/Icons/AppLogo.vue'
import BackGroundImage from '~/components/BackGroundImage.vue';

const isOpen = ref(false)

const { isLoggedIn, user } = useAuth();
const { latestCourse, getCourseTitle } = courseAsync();
const courses = ref<any>([]);
const courses_title = ref<any>([]);


courses.value = await latestCourse();
courses_title.value = await getCourseTitle();


</script>

<template>
    <MainLayout>
        <template #arva-logo>
            <a href="#" class="flex items-center">
              <AppLogo />
            </a>
        </template>
  
        <template #header-right>
        <template v-if="isLoggedIn">
            <NuxtLink to="/admin" class='px-8 py-3 md:text-1xl text-sm rounded-lg font-bold text-white bg-[#cf2525] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff]'>
            Dashboard
            </NuxtLink>
        </template>
        <template v-else>
            <NuxtLink
                to="/login"
                class='px-8 py-3 md:text-1xl text-sm rounded-lg font-bold text-white bg-[#cf2525] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff]'>
                Login
            </NuxtLink>
        </template>
       
            <!-- <NuxtLink
                to="/register"
                class='px-4 py-2 md:text-1xl text-sm rounded-lg font-bold text-white border-2 border-[#cf2525] bg-[#cf2525] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#cf2525]'>
                Sign up
            </NuxtLink> -->

            <UButton label="Open" color="gray" @click="isOpen = true" class='lg:hidden'>
                <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
                </svg>    
            </UButton>
        </template>
      
        <template #nav-menu>
            <USlideover v-model="isOpen" prevent-close>
            <UCard class="flex flex-col flex-1" :ui="{ body: { base: 'flex-1' }, ring: '', divide: 'divide-y divide-gray-100' }">
                <template #header>
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">
                        Ancienr Rusher VA
                    </h3>
                    <UButton color="gray" variant="ghost" icon="i-heroicons-x-mark-20-solid" class="-my-1" @click="isOpen = false" />
                </div>
                
                </template>
                <ul class="w-full text-center text-sm font-medium text-gray-900 ">
                    <li class="w-full px-4 py-2">
                    <NuxtLink
                        to="/"
                        class='hover:text-[#cf2525] block font-semibold text-lg text-[#cf2525]'>
                        Home
                    </NuxtLink>
                    </li>
                    <li class="w-full px-4 py-2">
                    <NuxtLink
                        to="/courses"
                        class='hover:text-[#cf2525] block font-semibold text-lg'>
                        Courses
                    </NuxtLink>
                    </li>
                    <li class="w-full px-4 py-2">
                    <NuxtLink
                        to="/about"
                        class='hover:text-[#cf2525] block font-semibold text-lg'>
                        About Us
                    </NuxtLink>
                    </li>
                    <li class="w-full px-4 py-2">
                    <NuxtLink
                        to="/community"
                        class='hover:text-[#cf2525] block font-semibold text-lg'>
                        Our Community
                    </NuxtLink>
                    </li>
                </ul>

            </UCard>
            </USlideover>
            <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-black" viewBox="0 0 320.591 320.591">
                <path
                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                    data-original="#000000"></path>
                <path
                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                    data-original="#000000"></path>
                </svg>
            </button>

            <ul
                class='lg:flex lg:gap-x-7 gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
                <li class='mb-6 hidden max-lg:block'>
                  <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui.svg" alt="logo" class='w-36' /></a>
                </li>
                <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'>
                  <a href='javascript:void(0)'
                    class='hover:text-[#cf2525] text-[#ffffff] block font-semibold text-2xl'>Home</a>
                </li>
                <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'>
                    <NuxtLink
                        to="/courses"
                        class='hover:text-[#cf2525] text-white block font-normal text-2xl'>
                        Courses
                    </NuxtLink>
                </li>
                <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'>
                    <NuxtLink
                        to="/about"
                        class='hover:text-[#cf2525] text-white block font-normal text-2xl'>
                        About Us
                    </NuxtLink>
                </li>
                <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'>       
                    <NuxtLink
                        to="/community"
                        class='hover:text-[#cf2525] text-white block font-normal text-2xl'>
                        Our Community
                    </NuxtLink>
                </li>
            </ul>
        </template>

        <template #content>
          <div>     
             <BackGroundImage />
          </div>
          <div class="flex flex-col xl:mt-10  py-4 px-10 gap-5">
            <div class="border-solid rounded-lg bg-white text-lg font-medium sm:w-100 w-64 p-4 text-center font-roboto">Never stop learning</div>
            <div>
                <div class="flex flex-row justify-items-center ">
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl w-1/2 font-bold text-left text-[#ffe700]">Enhance your skills by 
                    online courses with <br /> 
                    Ancient Rusher VA
                    </h1>
               
                </div>
            </div>
      
           
              <div class="flex">
                <div class="mt-1 sm:mt-0 lg:mt-5 inline-flex items-center">
                  <button type="button" class="px-4 py-2 md:text-3xl text-sm rounded-lg font-bold text-white border-2 border-[#cf2525] bg-[#cf2525] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#cf2525]">Explore Path</button>
                </div>
                <div class="flex p-3 hidden md:block">
                  <div class="md:flex items-center">
                    <div class="">
                        <img src="/pages/assets/review_image.png" class="responsive-image">
                    </div>
                    <div class="">
                        <div class=" flex items-center mb-2 md:text-3xl text-sm">
                          <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                          </svg>
                          <svg class="w-4 h-4 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                          </svg>
                          <div class="max-lg:hidden">
                            <p class="ms-1 text-sm font-medium text-gray-500 ">4.95 out of 5</p>
                        </div>
                      </div>
                      <div class="flex md:flex-col items-center">
                        <p class="font-semibold">(10k+ reviews)</p>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
            <div>
            <!-- asdasd -->
          </div>
          </div>
        </template>
        <template #popular-courses>
            <div class="mx-auto">

                
                <div class="py-16">
                    <div class="xl:container m-auto px-6 text-gray-600 md:px-12 xl:px-16">
                        <div class="lg:bg-gray-50 dark:lg:bg-darker lg:p-16 rounded-[4rem] space-y-6 md:flex flex-row-reverse md:gap-6 justify-center md:space-y-0 lg:items-center">
                            <div class="md:5/12 lg:w-1/2">
                                <div class="grid grid-cols-2 gap-5 mt-8">
                                    <img class="w-full rounded-lg" src="../assets/imgs/1.jpg" alt="office content 1">
                                    <img class="mt-4 w-full lg:mt-10 rounded-lg" src="../assets/imgs/2.jpg" alt="office content 2">
                                    <img class="mt-4 w-full lg:mt-10 rounded-lg ml-10" src="../assets/imgs/3.jpg" alt="office content 2">
                                </div>
                            </div>
                            <div class="md:7/12 lg:w-1/2">
                                <h2 class="text-3xl font-bold text-gray-900 md:text-4xl dark:text-white">
                                    ARVA offers Amazon masterclass courses with internships with our US-based partnered companies:
                                </h2>
                                <p class="mt-8 text-gray-600 dark:text-gray-300">
                                    1. Amazon Product Research - Online Arbitrage
                                </p>
                                <p class=" text-gray-600 dark:text-gray-300">
                                    2. Amazon Product Research - Wholesale
                                </p>
                                <p class=" text-gray-600 dark:text-gray-300">
                                    3. Amazon Seller Central Management
                                </p>
                                <div class="mt-3 divide-y space-y-4 divide-gray-100 dark:divide-gray-800">
                                    <div class="w-5/6">
                                    <p class="text-gray-500 dark:text-gray-400">Our classes are every weekend to accommodate the availability of our coaches and students. ARVA provides the tools necessary to give first-hand experience of the role of an Amazon product researcher and/or Amazon seller central manager. Having trouble during the class session? There is nothing to worry about—the coaches are always open to questions, and every class is recorded. Moreover, students will have lifetime access to the class recordings.</p>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex justify-center mt-16">
                    <p class="font-extrabold text-3xl sm:text-5xl lg:text-6xl">Latest Courses</p>
                </div>
                <div class="flex flex-wrap mt-20 justify-center">
                    <div class="grid lg:grid-cols-3 gap-4">
                    <CourseCard v-for='(item, index) in courses_title.course_title' :key='index' :courses_title.="item"/>
                </div>
            </div>
          
                <div class="flex flex-wrap mt-16 justify-center " data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                    <div class="grid lg:grid-cols-3 gap-4">
                        <Card v-for='(item, index) in courses.courses' :key='index' :course="item" />
                    </div>
                   
                </div>
            </div>
        </template>
        <template #courses-category>
            <div class="mx-auto">
                <div class="flex justify-center mt-16">
                    <p class="font-extrabold text-3xl sm:text-5xl lg:text-6xl">How it Works</p>
                </div>
                <div class="flex flex-wrap mt-20 justify-center">
                    <div class="">
                       Onlearing is one powerful online software suite that combines all the tools 
                       needed to run a successful school or office.
                    </div>
                </div>
                <div class="flex flex-wrap mt-20 justify-center">
                    <div class="max-w-52 xl:max-w-72 md:max-w-sm  text-center bg-white ">
                        <a href="#">
                            <img class="rounded-t-lg" src="/pages/assets/instruction/1_inst.png" alt="" />
                        </a>
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Select a Course</h5>
                        </a>
                        <p class="mb-11 px-6 font-normal text-gray-500">Go to this step by step guideline process on how to certify for your weekly benefits:</p>
                    </div>
                    <div class="max-w-52 xl:max-w-72 md:max-w-sm text-center">
                        <a href="#">
                            <img class="rounded-t-lg" src="/pages/assets/instruction/2_inst.png" alt="" />
                        </a>
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Fill Up The From</h5>
                        </a>
                        <p class="mb-11 px-6 font-normal text-gray-500">Go to this step by step guideline process on how to certify for your weekly benefits:</p>
                    </div>
                    <div class="max-w-52 xl:max-w-72 md:max-w-sm text-center">
                        <a href="#">
                            <img class="rounded-t-lg" src="/pages/assets/instruction/3_inst.png" alt="" />
                        </a>
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Send Payment</h5>
                        </a>
                        <p class="mb-11 px-6 font-normal text-gray-500">Go to this step by step guideline process on how to certify for your weekly benefits:</p>
                    </div>
                    <div class="max-w-52 xl:max-w-72 md:max-w-sm text-center">
                        <a href="#">
                            <img class="rounded-t-lg" src="/pages/assets/instruction/4_inst.png" alt="" />
                        </a>
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Check Email</h5>
                        </a>
                        <p class="mb-11 px-6 font-normal text-gray-500">Go to this step by step guideline process on how to certify for your weekly benefits:</p>
                    </div>
                  
                </div>
                <div class="flex justify-center mt-20 md:mt-44">
                 <button type="button" class=" px-4 py-2 md:text-xl text-sm rounded-full w-72 font-semibold text-white border-2 border-[#ff8100] bg-[#ff8100] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#cf2525]">Learn More</button>
                </div>
            </div>
        </template>
        <template #benefits>
            <div class="mx-auto">
                <div class="flex justify-center mt-16 mx-33">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 xl:w-1/2 ">
                            <div class="w-40 text-center p-2 bg-gray-100 border border-gray-200 rounded-lg shadow">
                                <p class="font-semibold text-lg ">Benefits</p>
                            </div>
                            <p class="font-bold lg:text-5xl text-3xl mt-5">Students wide range of benefits
                            </p>
                            <div class="relative overflow-x-auto">
                                <table class="text-sm text-left rtl:text-right text-gray-500 mt-12">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0 w-10 h-10">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Certifications and Career Advancement

                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="w-8 h-8">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Live classes

                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Lifetime recording access
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Internships
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Access to Top Instructors
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Learning Resources and Tools
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Comfortable Learning Environment
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/2 p-4" data-aos="fade-left" data-aos-duration="500" data-aos-easing="linear">
                            <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow">
                                <img class="" src="/pages/assets/signature.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full mt-16 mx-33">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 xl:w-1/2">
                            <div class=" p-6 bg-white ">
                                <img class="" src="/pages/assets/training-preview.png" data-aos="fade-right" data-aos-duration="500" data-aos-easing="linear">
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/2 p-2 flex flex-row justify-start">
                        <div>
                            <div class="w-40 text-center p-2 bg-sky-100 border border-gray-200 rounded-lg shadow">
                                <p class="font-semibold text-lg ">Training</p>
                            </div>
                            <p class="font-bold lg:text-5xl text-2xl mt-5 text-[#ff8100]">Staff Training</p>
                            <div class="relative overflow-x-auto">
                                <table class="text-sm text-left rtl:text-right text-gray-500 mt-12">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0 w-10 h-10">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                Teachers dont get lost in the grid view and have a 
                                                dedicated Podium space.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="w-8 h-8">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                TAs and presenters can be moved to the front of the class.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex shrink-0">
                                                    <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                </div>
                                            </th>
                                            <td class="px-6 py-3">
                                                <p class="text-lg font-medium">
                                                    Teachers can eaily see all students and class data 
                                                    at one time.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </template>
        <template #gift-card>
            <div class="mx-auto">
                <div class="mt-24 mx-33">
                    <div class="bg-red-500 overflow-visible border border-gray-200 rounded-lg shadow">
                        <div class="flex justify-start p-8 mx-33 relative">
                            <div class="grid lg:px-12">
                                <div class="lg:order-1 order-2  z-20">
                                    <p class="font-bold lg:text-5xl text-3xl text-white">Why should you enroll in ARVA?</p>
                                    <div class="relative overflow-x-auto">
                                        <table class="text-sm text-left rtl:text-right text-gray-500 mt-12">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                <tr>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="">
                                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                        <div class="flex shrink-0 w-10 h-10">
                                                            <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                        </div>
                                                    </th>
                                                    <td class="">
                                                        <p class="text-sm text-white font-medium">
                                                        Intensive theoretical and Practical Learnig
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                        <div class="flex shrink-0 w-10 h-10">
                                                            <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                        </div>
                                                    </th>
                                                    <td class="">
                                                        <p class="text-sm text-white font-medium">
                                                            Skills Development
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                                                        <div class="flex shrink-0 w-10 h-10">
                                                            <img class="w-8 h-8 rounded-full" src="/pages/assets/2.png">
                                                        </div>
                                                    </th>
                                                    <td class="">
                                                        <p class="text-sm text-white font-medium">
                                                        Cost-Effectiveness
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="lg:order-2 order-1">
                                    <div class="gift-card" data-aos="fade-left" data-aos-duration="500" data-aos-easing="linear">
                                        <img class="" src="/pages/assets/gift-card.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #exclusive-bundles>
            <div class="mx-auto">
                <div class="flex justify-center mt-16">
                    <p class="font-extrabold text-3xl sm:text-5xl lg:text-6xl">Exclusive Bundles</p>
                </div>
                <div class="flex flex-wrap mt-20 justify-center">
                       Onlearing is one powerful online software suite that combines all the tools 
                       needed to run a successful school or office.
                </div>


                <CarouselBanner/>
            
            </div>
        </template>
        <template #bottom-section>
            <footer class="py-24 w-full bg-[#ff8100] relative ">
                <div class="container mx-auto flex flex-col md:flex-row justify-between items-center  ">
                    <div class="text-center md:text-left mb-6 md:mb-0 ml-3 md:ml-0">
                    <a href="https://arva.com/" class="flex items-center">
                                <AppLogo />
                                <span class="self-center text-white text-2xl font-bold whitespace-nowrap">Ancient Rusher VA</span>
                    </a>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 21.914a1.5 1.5 0 01-2.121-2.121L17.657 12.757 12.757 7.657a1.5 1.5 0 012.121-2.121L16.5 12.757l5.157 5.157a1.5 1.5 0 010 2.121z" />
                        </svg>
                        <a href="#" class="ml-2 text-white hover:text-gray-800">Address: &nbsp;</a>
                        <p class="text-white"> Rose Streen balasan Davao del Sur, Philippines, 8005</p>
                        </li>
                        <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1.28a1 1 0 01-1.024-.685l-1.499-4.493a1 1 0 01.502-1.21l2.257-1.13a11.042 11.042 0 00-5.516-5.516l-1.13 2.257a1 1 0 01-1.21.502l-4.493-1.498a1 1 0 01-.684-.949V5z" />
                        </svg>
                        <a href="#" class="ml-2 text-white hover:text-gray-800">Tel: +639075323055</a>
                        </li>
                        <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <a href="#" class="ml-2 text-white hover:text-gray-800">Fb Page: <a href="https://www.facebook.com/AncientRusherVA/">https://www.facebook.com/AncientRusherVA/</a>
                        </a>
                        </li>
                        <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="#" class="ml-2 text-white hover:text-gray-800">Email: info@ancientrusherva.com</a>
                        </li>
                    </ul>
                    </div>
                    <div class="md:ml-10">
       
                    </div>
                    <div class="md:ml-10">
                    <h2 class="text-2xl font-bold text-white mb-4 mt-10">
                        <h2 class="text-sm font-semibold text-white mb-4">Stay up to date with the latest courses</h2></h2>
                        <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        </div>
                            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"required />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Send</button>
                        </div>
                    </div>
                </div>
            </footer>

        </template>
    </MainLayout>
</template>


<style scoped>
 .image-container {
  background-size: cover;
  background-position: center;
  height: 100%;
  width: 100%;
  background-image: url('/pages/assets/5.png');
  }

  .responsive-image {
    /* You can also add a default width and height if you want */
    width: 100px;
  }

  .gift-card{
    position: absolute;
    bottom: 0px; /* add some margin to the bottom */
    right: 100px; /* add some margin to the right */

  }

  .total-students{
    position: absolute;
    width: 100%;
    justify-content: center
  }

  .footer-table{
    bottom: 0px; /* add some margin to the bottom */
  }



@media only screen and (max-width: 576px) {
        .responsive-image {
            width: 50px;
        }
        
}

@media only screen and (max-width: 1024px) {
        .gift-card {
            right: 0px;
            position: absolute;
            bottom: 0px; /* add some margin to the bottom */
            
        }
}

</style>