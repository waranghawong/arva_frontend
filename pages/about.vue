<script setup lang="ts">
import MainLayout from './layout/MainLayout.vue'
import AppLogo from './assets/Icons/AppLogo.vue'
import OurCommunityCover from '~/components/OurCommunityCover.vue';

const { isLoggedIn, user } = useAuth();


const router = useRouter();
const route = useRoute();
const { login } = useAuth();

const data = reactive({
  email: "",
  password: "",
  remember: false,
});
const status = ref(
  (route.query.reset ?? "").length > 0 ? atob(route.query.reset as string) : ""
);


const isOpen = ref(false)

const {
  submit,
  inProgress,
  validationErrors: errors,
} = useSubmit(
  () => {
    status.value = "";
    return login(data);
  },
  {
    onSuccess: () => router.push("/dashboard"),
  }
);
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
                        class='hover:text-[#cf2525] block font-semibold text-lg'>
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
                        class='hover:text-[#cf2525] block font-semibold text-lg text-[#cf2525]'>
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
                    <NuxtLink
                        to="/"
                        class='hover:text-[#cf2525] text-white block font-normal text-2xl'>
                        Home
                    </NuxtLink>
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
                        class='hover:text-[#cf2525] text-white block font-semibold text-2xl'>
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
             <AboutCover />
          </div>
        </template>
        <template #popular-courses>
            <div class="mx-auto">
               
                <div class="py-16 mt-38">
                    <!-- <div class="container w-full grid grid-cols-6 gap-4">
                        <div class="col-start-2 bg-yellow-600 col-span-4 content-center     ...">
                            <div class="mt-4  space-y-4 justify-center sm:mt-0 sm:text-left">
                                <p class="w-1/2 text-black font-bold">
                                    Ancient Rusher VA (ARVA) started in 2022 helping Coach Jerson’s friends and families become Amazon VAs.
                                     In 2024, ARVA started to expand its name to help more Filipinos who wish to change the course of their lives
                                </p>
                            </div>
                            <div class="mt-4 space-y-4 text-center sm:mt-0 sm:text-left">
                                <p class="text-black font-bold">
                                    Ancient Rusher VA (ARVA) consists of coaches with profound experience in their designated courses.
                                     We help Filipinos by forming the skills and becoming quality Amazon VAs.
                                </p>
                            </div>
                        </div>
                        <div class="col-start-1 bg-yellow-600 col-end-3 ...">02</div>
                        <div class="col-end-7 col-span-2 bg-yellow-600 ...">03</div>
                        <div class="col-start-1 col-end-7 bg-yellow-600 ...">04</div>
                      </div> -->
                    <div class="xl:container m-auto px-6 text-gray-600 dark:text-gray-300 md:px-12 xl:px-6">
                      <div class="grid gap-8 md:grid-rows-2 lg:grid-cols-2">
                        <div class="row-span-2 p-8 text-center shadow-2xl shadow-gray-600/10 dark:shadow-none">
                          <div class="flex h-full flex-col justify-center space-y-4">
                            <img class="mt-4 w-full rounded-lg" src="../assets/imgs/4.jpg" alt="office content 2">
                            <div class="flex flex-row ">
                                <img class="mt-4 w-1/2 rounded-lg p-2" src="../assets/about_us/4.png" alt="office content 2">
                                <img class="mt-4 w-1/2 rounded-lg p-2" src="../assets/about_us/2.png" alt="office content 2">
                            </div>
                           
                          </div>
                        </div>
                            <div class="mt-4 space-y-4 text-start sm:mt-0 sm:text-left">
                                <p class="text-black font-bold w-2/3">
                                    Ancient Rusher VA (ARVA) started in 2022 helping Coach Jerson’s friends and families become Amazon VAs.
                                    In 2024, ARVA started to expand its name to help more Filipinos who wish to change the course of their lives
                                </p>
                                <p class="text-black font-bold w-2/3">
                                    Ancient Rusher VA (ARVA) consists of coaches with profound experience in their designated courses.
                                    We help Filipinos by forming the skills and becoming quality Amazon VAs.
                                </p>
                            </div>
                      
                            <div class="text-start sm:mt-0 sm:text-left">
                                <div class="grid grid-rows-3 grid-flow-col gap-4">
                                    <div class="col-start-1 row-span-2 ..."><img class=" w-full rounded-lg" src="../assets/about_us/3.png" alt="office content 2"></div>
                                    <div class="row-start-3 row-start-4 ..."><img class="w-full rounded-lg" src="../assets/about_us/1.png" alt="office content 2"></div>
                                    <div class="row-start-3 row-span-2 ..."><img class=" w-full rounded-lg" src="../assets/about_us/5.jpg" alt="office content 2"></div>
                                    <div class="row-start-1 row-end-4 ..."><img class="w-full rounded-lg" src="../assets/about_us/6.jpg" alt="office content 2"></div>
                                  </div>
                            </div>
                      </div>
                    </div>
                  </div>
                                                      
              
                <!-- <div class="flex justify-start mt-16 px-5 sm:px-10 md:px-30 lg:px-40 " >
                    <p class="font-bold text-3xl sm:text-2xl lg:text-3xl">Ancient Rusher VA is....</p>
                </div>
                <div class="flex justify-center mt-6 px-5 sm:px-10 md:px-30 lg:px-40 ">
                    <p class="text-justify text-xl">
                        Not just a virtual database, VAA is a community of skilled and talented VAs from the Philippines, especially screened and selected. As part of the exclusive VAA team, our VAs receive ongoing training, enrichment, and support. Our management and training staff based in the Philippines ensure an ongoing sense of community, professional improvement, and fun! This is what makes the VAA community so special and strong, and what enables us to maintain such high-quality, reliable VA services to Amazon sellers worldwide.
                    </p>
                </div>

                <div class="flex justify-start mt-16 px-5 sm:px-10 md:px-30 lg:px-40 ">
                    <p class="font-bold text-3xl sm:text-2xl lg:text-3xl">At Ancient Rusher VA....</p>
                </div>
                <div class="flex justify-center mt-6">
                    <p class="text-justify text-xl px-5 sm:px-10 md:px-30 lg:px-40 ">
                        Lorem ipsum dolor sit amet. Vel placeat aperiam ut similique itaque in blanditiis quas est corporis voluptas. Qui iste quos non autem aliquam hic quia autem aut nisi rerum aut blanditiis repellendus.
                    </p>
                </div>

                <div class="flex justify-start mt-16 px-5 sm:px-10 md:px-30 lg:px-40 ">
                    <p class="font-bold text-3xl sm:text-2xl lg:text-3xl">Ancient Rusher VA's founders live and breathe Amazon every single day</p>
                </div>
                <div class="flex justify-center mt-6">
                    <p class="text-justify text-xl px-5 sm:px-10 md:px-30 lg:px-40 ">
                        Lorem ipsum dolor sit amet. Vel placeat aperiam ut similique itaque in blanditiis quas est corporis voluptas. Qui iste quos non autem aliquam hic quia autem aut nisi rerum aut blanditiis repellendus.
                    </p>
                </div> -->
            </div>

            <div class="mx-auto">
                <div class="py-16 mt-38">
                        <!-- <div class="container w-full grid grid-cols-6 gap-4">
                            <div class="col-start-2 bg-yellow-600 col-span-4 content-center     ...">
                                <div class="mt-4  space-y-4 justify-center sm:mt-0 sm:text-left">
                                    <p class="w-1/2 text-black font-bold">
                                        Ancient Rusher VA (ARVA) started in 2022 helping Coach Jerson’s friends and families become Amazon VAs.
                                         In 2024, ARVA started to expand its name to help more Filipinos who wish to change the course of their lives
                                    </p>
                                </div>
                                <div class="mt-4 space-y-4 text-center sm:mt-0 sm:text-left">
                                    <p class="text-black font-bold">
                                        Ancient Rusher VA (ARVA) consists of coaches with profound experience in their designated courses.
                                         We help Filipinos by forming the skills and becoming quality Amazon VAs.
                                    </p>
                                </div>
                            </div>
                            <div class="col-start-1 bg-yellow-600 col-end-3 ...">02</div>
                            <div class="col-end-7 col-span-2 bg-yellow-600 ...">03</div>
                            <div class="col-start-1 col-end-7 bg-yellow-600 ...">04</div>
                          </div> -->
                        <div class="xl:container m-auto px-6 text-gray-600 dark:text-gray-300 md:px-12 xl:px-6">
                          <div class="grid lg:grid-cols-2">
                            <div class="content-center place-content-center">
                                <p class="text-black font-bold w-2/3 text-balance= whitespace-normal">
                                    ARVA offers Amazon VA masterclass courses and internships with our partnered US-based companies. 
                                    Our masterclass courses are Amazon Product Research - Online Arbitrage, Amazon Wholesale,
                                     and Amazon Seller Central Management. We not only teach our students in ARVA but also help 
                                     them develop the necessary skills needed for Amazon VAs. We offer hands-on training and internships 
                                     to give our students first-hand experience as product researchers and/or seller central managers. 
                                </p>
                                <br>
                                <p class="text-black font-bold w-2/3">
                                    We guide our students from enrollment until employment. We provide paid tools for better learning and
                                     give lifetime access to the recordings of our training each batch. 
                                    Our line is always open for questions and assistance even after our students finish training. 
                                </p>
                            </div>
                            <div class="content-center">
                                <img class=" w-1/2 justify-self-center rounded-lg" src="../assets/about_us/8.jpg" alt="office content 2">
                                <img class="w-full rounded-lg mt-4" src="../assets/about_us/7.jpg" alt="office content 2">
                            </div>
                          </div>
                        </div>
                    </div>
                      
                                                      
              
                <!-- <div class="flex justify-start mt-16 px-5 sm:px-10 md:px-30 lg:px-40 " >
                    <p class="font-bold text-3xl sm:text-2xl lg:text-3xl">Ancient Rusher VA is....</p>
                </div>
                <div class="flex justify-center mt-6 px-5 sm:px-10 md:px-30 lg:px-40 ">
                    <p class="text-justify text-xl">
                        Not just a virtual database, VAA is a community of skilled and talented VAs from the Philippines, especially screened and selected. As part of the exclusive VAA team, our VAs receive ongoing training, enrichment, and support. Our management and training staff based in the Philippines ensure an ongoing sense of community, professional improvement, and fun! This is what makes the VAA community so special and strong, and what enables us to maintain such high-quality, reliable VA services to Amazon sellers worldwide.
                    </p>
                </div>

                <div class="flex justify-start mt-16 px-5 sm:px-10 md:px-30 lg:px-40 ">
                    <p class="font-bold text-3xl sm:text-2xl lg:text-3xl">At Ancient Rusher VA....</p>
                </div>
                <div class="flex justify-center mt-6">
                    <p class="text-justify text-xl px-5 sm:px-10 md:px-30 lg:px-40 ">
                        Lorem ipsum dolor sit amet. Vel placeat aperiam ut similique itaque in blanditiis quas est corporis voluptas. Qui iste quos non autem aliquam hic quia autem aut nisi rerum aut blanditiis repellendus.
                    </p>
                </div>

                <div class="flex justify-start mt-16 px-5 sm:px-10 md:px-30 lg:px-40 ">
                    <p class="font-bold text-3xl sm:text-2xl lg:text-3xl">Ancient Rusher VA's founders live and breathe Amazon every single day</p>
                </div>
                <div class="flex justify-center mt-6">
                    <p class="text-justify text-xl px-5 sm:px-10 md:px-30 lg:px-40 ">
                        Lorem ipsum dolor sit amet. Vel placeat aperiam ut similique itaque in blanditiis quas est corporis voluptas. Qui iste quos non autem aliquam hic quia autem aut nisi rerum aut blanditiis repellendus.
                    </p>
                </div> -->
            </div>

            <div class="flex justify-center mt-48">
                    <p class="font-extrabold text-3xl text-black sm:text-5xl lg:text-3xl">MEET THE TEAM</p>
            </div>
            <div class="flex flex-wrap mt-12 justify-center">
                <p class="text-center  text-xl px-5 sm:px-10 md:px-30 lg:px-40 ">
                    With an enthusiastic team, you can achieve almost anything.
                    </p>
                   
            </div>
            
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
             
                    <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                        <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="../assets/the_team/1.jpg"  alt="Jerson Blanco">
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a href="#">Jerson Blanco</a>
                                </h3>
                                <span class="text-gray-500 dark:text-gray-400">CEO / Founder</span>
                                <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">Jerson drives the technical strategy of the arva platform and brand.</p>
                                <ul class="flex space-x-4 sm:mt-0">
                                    <!-- <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div> 
                        <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="../assets/the_team/2.jpg"  alt="Cris Aldrin Paller">
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a href="#">Cris Aldrin Paller</a>
                                </h3>
                                <span class="text-gray-500 dark:text-gray-400">Amazon Product Research - Online Arbitrage</span>
                                <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">cris drives the technical strategy of the ARVA platform and brand.</p>
                                <ul class="flex space-x-4 sm:mt-0">
                                    <!-- <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div> 
                        <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="../assets/the_team/3.jpg"  alt="Pearl Joy Gicain Narvaza">
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a href="#">Pearl Joy Gicain Narvaza</a>
                                </h3>
                                <span class="text-gray-500 dark:text-gray-400">Amazon Product Research - Wholesale</span>
                                <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">Pearl drives the technical strategy of the ARVA platform and brand.</p>
                                <ul class="flex space-x-4 sm:mt-0">
                                    <!-- <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div> 
                        <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="../assets/the_team/4.jpg"  alt="Jeanyveb Soberano">
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a href="#">Jeanyveb Soberano</a>
                                </h3>
                                <span class="text-gray-500 dark:text-gray-400">SMM/EA</span>
                                <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">Jeanyveb drives the technical strategy of the ARVA platform and brand.</p>
                                <ul class="flex space-x-4 sm:mt-0">
                                    <!-- <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>  
                        <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="../assets/the_team/5.jpg"  alt="Jessa Mae Blanco">
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a href="#">Jessa Mae Blanco</a>
                                </h3>
                                <span class="text-gray-500 dark:text-gray-400">Customer Service</span>
                                <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">Lana drives the technical strategy of the flowbite platform and brand.</p>
                                <ul class="flex space-x-4 sm:mt-0">
                                    <!-- <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>  
                    </div>  
                </div>
              </section>                        
                                                  
                                                  

            <!-- <div class="container mx-auto p-4 pt-6 md:p-6 lg:p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                    <img class="rounded-t-lg" src="/pages/assets/the_team/1.png" alt="" />
                </div>
                <div class="p-4" data-aos="fade-left" data-aos-duration="500" data-aos-easing="linear">
                    <p >
                        <span class="font-bold">Background</span> Lorem ipsum dolor sit amet. In quia similique in atque nobis est tenetur eaque est aperiam delectus. Est dolorem molestiae rem dolor ipsum id enim dolorem
                    </p>
                  
                </div>
                <div class="p-4" data-aos="fade-right" data-aos-duration="500" data-aos-easing="linear">
                    <p class="md:block min-[320px]:hidden">
                        <span class="font-bold">Kim Randolf Gallerto</span> Lorem ipsum dolor sit amet. In quia similique in atque nobis est tenetur eaque est aperiam delectus. Est dolorem molestiae rem dolor ipsum id enim dolorem
                    </p>
                    <img class="rounded-t-lg sm:block md:hidden" src="/pages/assets/the_team/2.png" alt="" />
                </div>
                <div class="p-4" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                    <img class="rounded-t-lg min-[320px]:hidden md:block" src="/pages/assets/the_team/2.png" alt="" />
                    <p class="sm:block md:hidden">
                        <span class="font-bold">Kim Randolf Gallerto</span> Lorem ipsum dolor sit amet. In quia similique in atque nobis est tenetur eaque est aperiam delectus. Est dolorem molestiae rem dolor ipsum id enim dolorem
                    </p>
                </div>
                <div class="p-4" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                    <img class="rounded-t-lg" src="/pages/assets/the_team/3.png" alt="" />
                </div>
                <div class="p-4" data-aos="fade-left" data-aos-duration="500" data-aos-easing="linear">
                    <p>
                        <span class="font-bold">Johannah Aro</span> Lorem ipsum dolor sit amet. In quia similique in atque nobis est tenetur eaque est aperiam delectus. Est dolorem molestiae rem dolor ipsum id enim dolorem
                    </p>
                </div>
                <div class="p-4" data-aos="fade-right" data-aos-duration="500" data-aos-easing="linear">
                    <p class="min-[320px]:hidden lg:block">
                        <span class="font-bold">Chris Aldren Paller</span> Lorem ipsum dolor sit amet. In quia similique in atque nobis est tenetur eaque est aperiam delectus. Est dolorem molestiae rem dolor ipsum id enim dolorem
                    </p>
                    <img class="rounded-t-lg sm:block lg:hidden" src="/pages/assets/the_team/4.png" alt="" />
                </div>
                <div class="p-4" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                    <img class="rounded-t-lg min-[320px]:hidden lg:block" src="/pages/assets/the_team/4.png" alt="" />
                    <p class="sm:block  lg:hidden">
                        <span class="font-bold">Chris Aldren Paller</span> Lorem ipsum dolor sit amet. In quia similique in atque nobis est tenetur eaque est aperiam delectus. Est dolorem molestiae rem dolor ipsum id enim dolorem
                    </p>
                </div>
                <!-- <div class="bg-orange-100 p-4">Column 1, Row 5</div>
                <div class="bg-orange-100 p-4">Column 2, Row 5</div> -->
            <!-- </div>
            </div> --> -->

            <!-- <div class="flex flex-wrap mt-16 justify-center " data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                <div class="max-w-sm lg:max-w-xs xl:max-w-md h-full">
                        <img class="rounded-t-lg" src="/pages/assets/the_team/1.png" alt="" />
                </div>
                <div class="max-w-md h-full">
                        <img class="rounded-t-lg" src="/pages/assets/the_team/2.png" alt="" />
                </div>
                <div class="max-w-sm lg:max-w-xs xl:max-w-md h-full">
                        <img class="rounded-t-lg" src="/pages/assets/the_team/3.png" alt="" />
                </div>
                <div class="max-w-sm lg:max-w-xs xl:max-w-md h-full">
                        <img class="rounded-t-lg" src="/pages/assets/the_team/4.png" alt="" />
                </div>
            </div> -->
    
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
                <CarouselBanner />
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