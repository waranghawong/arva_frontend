<script setup lang="ts">
import Autoplay from 'embla-carousel-autoplay'
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel'
import { Card, CardContent } from '@/components/ui/card'

const plugin = Autoplay({
  delay: 2000,
  stopOnMouseEnter: true,
  stopOnInteraction: false,
})

const items = [{
  name: 'Sébastien Chopin',
  review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
  avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/atinux' }
}, {
  name: 'Pooya Parsa',
  review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
  avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/pi0' }
}, {
  name: 'Daniel Roe',
  review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
  avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/danielroe' }
}, {
  name: 'Anthony Fu',
  review: 'Lorem ipsum dolor sit amet. Id assumenda enim hic nobis harum ea quibusdam nihil sit harum debitis et minus velit ab reiciendis internos et distinctio earum. Sed saepe natus et fugit rerum aut soluta ratione ut totam quia qui itaque officia! Et maxime quas qui nesciunt dignissimos est vitae magnam ut impedit labore. Non asperiores vitae aut molestiae itaque aut fugiat corporis ea rerum veniam.',
  avatar: { src: 'https://ipx.nuxt.com/f_auto,s_192x192/gh_avatar/antfu' }
}]
const { featuredCourse } = courseAsync();
const courses = ref<any>([]);
courses.value = await featuredCourse();
// const items = [
//   'https://picsum.photos/600/800?random=1',
//   'https://picsum.photos/600/800?random=2',
//   'https://picsum.photos/600/800?random=3',
//   'https://picsum.photos/600/800?random=4',
//   'https://picsum.photos/600/800?random=5',
//   'https://picsum.photos/600/800?random=6'
// ]


const carouselRef = ref()

function convertDate(dates){
    const new_date = new Date(dates);

    const month = new_date.toLocaleString('default', { month: 'long' });
    const day = new_date.getDate();
    const year = new_date.getFullYear();

    const formattedDateFrom = `${month} ${day} ${year}`;

    return formattedDateFrom;
}

onMounted(() => {
setInterval(() => {
  if (!carouselRef.value) return

  if (carouselRef.value.page === carouselRef.value.pages) {
    return carouselRef.value.select(0)
  }

  carouselRef.value.next()
}, 3000)
})
</script>

<template>
    <div>
        <UContainer class=" ">
            <div class="flex flex-wrap mt-20 mb-32 content-center">
                <UCarousel
                        ref="carouselRef"
                        v-slot="{ item,index }"
                        :items="courses.courses"
                        :ui="{
                        item: 'basis-full  justify-center',
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
                        class="w-full mx-auto"
                    >
                    <!-- center this div -->
                    <div  class="flex flex-wrap mt-20 mb-32 justify-center" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                        <div
                        class="flex flex-col rounded-lg border bg-white text-surface shadow-secondary-1 md:max-w-xl md:flex-row">
                
<!--                
                            <img
                                class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:!rounded-none md:!rounded-s-lg"
                                src="/pages/assets/5.png"
                                alt="" /> -->
                            <img class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:!rounded-none md:!rounded-s-lg" :src="`${useRuntimeConfig().public.backendUrl}/images/${item.profile_picture}`" alt="" />
                            <div class="flex flex-col justify-start p-6">
                                <p class="mb-4">{{  convertDate(item.course_from) }} - {{ convertDate(item.course_to) }}</p>
                                <h1 class="text-2xl font-bold text-gray-800">
                                        {{ item.course_offer }}
                                    </h1>
                                <p class="mb-4 text-base mt-10  truncate max-w-[40ch] overflow-hidden ">
                                    {{item.description}}
                                </p>
                                <p class="text-xs text-surface/75">
                                    <div class="w-60 place-items-center p-2 bg-gray-50 border border-gray-200 rounded-full shadow">
                                            <div class="flex -space-x-4 rtl:space-x-reverse">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <a class="flex items-center justify-right bg-gray-100 w-10 h-10  text-md font-medium border-2 whitespace-nowrap border-white rounded-full hover:bg-gray-600" href="#">+99 Students</a>
                                     
                                            </div>
                                        </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </UCarousel>
                <!-- <UCarousel
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
                   
                    <div class="flex flex-wrap mt-20 mb-32 justify-center" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
                        <div
                        class="flex flex-col rounded-lg border bg-white text-surface shadow-secondary-1 md:max-w-xl md:flex-row">
        
                            <img
                                class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:!rounded-none md:!rounded-s-lg"
                                src="/pages/assets/5.png"
                                alt="" />
                              
                            <div class="flex flex-col justify-start p-6">
                                <p class="mb-4">1-28 july 2024</p>
                                <h1 class="text-2xl font-bold text-gray-800">
                                        Course 1
                                    </h1>
                                <p class="mb-4 text-base mt-10">
                                    Lorem ipsum odor amet, consectetuer adipiscing elit. 
                                    Potenti donec finibus dapibus turpis malesuada 
                                    fermentum at. Himenaeos eleifend eget platea potenti 
                                    nunc consectetur commodo suscipit ut.
                                </p>
                                <p class="text-xs text-surface/75">
                                    <div class="w-60 place-items-center p-2 bg-gray-50 border border-gray-200 rounded-full shadow">
                                            <div class="flex -space-x-4 rtl:space-x-reverse">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <img class="w-10 h-10 border-2 border-white rounded-full" src="/pages/assets/2.png" alt="">
                                                <a class="flex items-center justify-right bg-gray-100 w-10 h-10  text-md font-medium border-2 whitespace-nowrap border-white rounded-full hover:bg-gray-600" href="#">+99 Students</a>
                                     
                                            </div>
                                        </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </UCarousel> -->
            </div>
        </UContainer>
    
        
    </div>
</template>