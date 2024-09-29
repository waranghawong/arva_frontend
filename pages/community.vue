<script setup lang="ts">
import MainLayout from './layout/MainLayout.vue'
import AppLogo from './assets/Icons/AppLogo.vue'
import OurCommunityCover from '~/components/OurCommunityCover.vue';
import Carousel  from '~/components/Carousel.vue';

const { isLoggedIn, user } = useAuth();

const router = useRouter();
const route = useRoute();

const carouselRef = ref()

// const items = [{
//   name: 'Sébastien Chopin',
//   review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
//   avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/atinux' }
// }, {
//   name: 'Pooya Parsa',
//   review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
//   avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/pi0' }
// }, {
//   name: 'Daniel Roe',
//   review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
//   avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/danielroe' }
// }, {
//   name: 'Anthony Fu',
//   review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
//   avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/antfu' }
// }]

const items = [
  '1.png',
  '2.png',
  '3.png',
  '4.png',
  '5.png',
  '6.png',
  '7.png',
  '8.png'
]

const isOpen = ref(false)

onMounted(() => {
  setInterval(() => {
    if (!carouselRef.value) return

    if (carouselRef.value.page === carouselRef.value.pages) {
      return carouselRef.value.select(0)
    }

    carouselRef.value.next()
  }, 5000)
})

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
                        class='hover:text-[#cf2525] block font-semibold text-lg'>
                        About Us
                    </NuxtLink>
                    </li>
                    <li class="w-full px-4 py-2">
                    <NuxtLink
                        to="/community"
                        class='hover:text-[#cf2525] block font-semibold text-lg text-[#cf2525]'>
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
                        class='hover:text-[#cf2525] text-white block font-normal text-2xl'>
                        About Us
                    </NuxtLink>
                </li>
                <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'>       
                    <NuxtLink
                        to="/community"
                        class='hover:text-[#cf2525] text-white block font-semibold text-2xl'>
                        Our Community
                    </NuxtLink>
                </li>
            </ul>
        </template>
        <template #content>
          <div>     
             <OurCommunityCover />
          </div>
        </template>
        <template #popular-courses>
            <div class="mx-auto">
                <section class="bg-white dark:bg-gray-900 mb-52">
                    <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                        <div class="font-light text-black sm:text-lg dark:text-gray-400">
                            <img class="mt-4 hidden lg:block w-1/2 lg:mt-10 rounded-lg" src="../assets/imgs/5.png" alt="office content 2">
                        </div>
                        <div class="flex flex-col items-center lg:items-end">
                            <p class="mb-4 text-black font-bold">Here at Ancient Rusher VA, we leave no man behind. We will be with you from today until you believe you can stand on your own.</p>
                            <img class="mt-4 w-3/4 mt-16 rounded-lg" src="../assets/imgs/4.jpg" alt="office content 2">
                        </div>
                    </div>
                </section>
            </div>

            <div class="flex justify-center mt-32">
                <p class="text-black font-extrabold text-center text-5xl sm:text-3xl lg:text-5xl">OUR STUDENTS</p>
            </div>

            <section class="bg-white dark:bg-gray-900 mb-52">
                <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                    <div class="font-light text-black sm:text-lg dark:text-gray-400">
                        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-black dark:text-white">We didn't reinvent the wheel</h2>
                        <p class="mb-4 text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non ligula egestas, iaculis nibh vitae, vestibulum quam. Sed nec magna ut nisi tincidunt molestie. Nulla in fermentum mi. Suspendisse gravida, eros id dignissim dignissim, enim sapien eleifend felis, sed vehicula sapien odio eleifend metus. Phasellus tempor justo ac egestas congue. Pellentesque elit dolor, malesuada nec neque eget, vehicula dictum est. Sed in nisl venenatis, rutrum tortor id, euismod tellus. Ut sed urna sed enim consequat facilisis. Maecenas semper, nunc non sagittis sollicitudin, odio tortor fermentum eros, nec tempor est felis vitae elit. Integer nisl metus, tincidunt ac ornare quis, iaculis id felis. Praesent vitae arcu et nulla malesuada blandit vitae ut purus. Praesent dictum sapien vitae scelerisque congue. Sed vel viverra purus. Sed dignissim lectus eu lectus fringilla ultrices. Fusce accumsan, lectus vitae tempus sagittis, ante turpis ultrices velit, vel egestas erat felis quis lacus.</p>
                        <p class="text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non ligula egestas, iaculis nibh vitae, vestibulum quam. Sed nec magna ut nisi tincidunt molestie. Nulla in fermentum mi. Suspendisse gravida.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <img class="w-full rounded-lg" src="../assets/our_students/1.png" alt="office content 1">
                        <img class="mt-4 w-full lg:mt-10 rounded-lg" src="../assets/our_students/2.png" alt="office content 2">
                        <img class="mt-4 w-full lg:mt-10 rounded-lg" src="../assets/our_students/3.png" alt="office content 2">
                        <img class="mt-4 w-full lg:mt-10 rounded-lg" src="../assets/our_students/4.png" alt="office content 2">
                    </div>
                </div>
            </section>

            <div class="flex justify-center mt-64">
                    <p class=" text-black font-extrabold text-center text-3xl sm:text-xl lg:text-5xl">OUR STUDENTS REVIEWS and SUCCESS</p>
            </div>
       
           

            <div class="inline-flex items-center justify-center w-full mt-16">
                <hr class="w-1/2 h-1 my-8 bg-gray-200 border-0 rounded">
                <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                    </svg>
                </div>
            </div>
       
            <div class="inline-flex items-center justify-center w-full">
                <UContainer>
                    <div class="flex flex-wrap mt-20 mb-32 content-center" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                        <UCarousel
                            ref="carouselRef"
                            v-slot="{ item }"
                            :items="items"
                            :ui="{
                            item: 'w-full',
                            container: 'rounded-lg'
                            }"
                            :prev-button="{
                            color: 'gray',
                            icon: 'i-heroicons-arrow-left-20-solid',
                            class: '-left-12'
                            }"
                            :next-button="{
                            color: 'gray',
                            icon: 'i-heroicons-arrow-right-20-solid',
                            class: '-right-12'
                            }"
                            arrows
                            class="md:w-1/2 w-64 mx-auto"
                        
                            >
                           
                            <img :src="'_nuxt/assets/reviews/'+item" class="w-full" draggable="false">
                        </UCarousel>
                    </div>
                </UContainer>
            
                
            </div>


            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-1/2 h-1 my-8 bg-gray-200 border-0 rounded">
                <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 ">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                    </svg>
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