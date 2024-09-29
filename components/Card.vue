<script setup>
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'


const loading = ref(false)
const props = defineProps(['course']);

const ispaymentDiaglogOpen = ref(false);

const togglePaymentDialog = () => {
    ispaymentDiaglogOpen.value = !ispaymentDiaglogOpen.value;
};

function convertDate(dates){
    const new_date = new Date(dates);

    const month = new_date.toLocaleString('default', { month: 'long' });
    const day = new_date.getDate();
    const year = new_date.getFullYear();

    const formattedDateFrom = `${month} ${day} ${year}`;

    return formattedDateFrom;
}

</script>
<template>
  <div class="max-w-sm lg:max-w-xs xl:max-w-sm h-full mx-10  border border-gray-200 rounded-lg shadow relative">
    <NuxtLink
        :to="{
            path: 'course',
            query: { id: course.id },
            params: { courseId: course.id, paramName: 'paramValue' }
        }"
    >
        <img class="rounded-t-lg" :src="`${useRuntimeConfig().public.backendUrl}/internship/${course?.course_internship?.profile_picture}`" alt="" />
    </NuxtLink>
    <div class="total-students flex">
        <div class="w-full justify-center flex -space-x-4 rtl:space-x-reverse p-2 bg-gray-50 border border-gray-200 rounded-full shadow">
            <img class="w-8 h-8 border-2 border-white rounded-full" src="/pages/assets/6.png" alt="">
            <img class="w-8 h-8 border-2 border-white rounded-full" src="/pages/assets/5.png" alt="">
            <img class="w-8 h-8 border-2 border-white rounded-full" src="/pages/assets/5.png" alt="">
            <img class="w-8 h-8 border-2 border-white rounded-full" src="/pages/assets/gift-card.png" alt="">
            <a class="flex items-center justify-right bg-gray-100 w-8 h-8  text-sm font-medium border-2 whitespace-nowrap border-white rounded-full hover:bg-gray-200" href="#">+40 students</a>
        </div>
    </div>
    <div class="p-5 bg-white mt-7">
        
        <!-- <p class="mb-4 mt-10 italic ">{{  convertDate(course.course_from) }} - {{ convertDate(course.course_to) }}</p> -->
        <nuxt-link :to="{ path: 'courses', hash: '#'+course.section_id }">
            <h5 class="mb-2 text-2xl font-bold text-gray-900 text-balance mt-7">{{ course.course_offer }}
            </h5>
        </nuxt-link>

        <p class="mb-3 font-normal text-gray-700 truncate max-w-[40ch] overflow-hidden ">Coach {{ course.instructor_name }}</p>
        <div class="flex xl:mb-0 md:mb-7">
            <span class="text-red-900 font-bold mb-2">Php {{ course.price_after }} &nbsp;</span><span class="line-through ...">Php {{ course.price_before }}</span>
        </div>
        <!-- {{ course?.course_internship?.lesson_training}} -->
        <ul class="max-w-md space-y-1 text-black list-disc list-inside dark:text-gray-400">
            <li v-for="(item, index) in course?.course_internship?.lesson_training" :key="index">
              {{ item }}
            </li>
          </ul>
        <!-- <p class="mb-3 font-normal text-gray-700 truncate max-w-[40ch] overflow-hidden ">{{ course.description }}</p> -->
        <div class="flex flex-col mt-2">
        
            <nuxt-link :to="{ path: 'courses', hash: '#'+course.section_id }"
                class="text-black mt-8 border border-orage-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-4 text-center me-2 mb-2 dark:focus:ring-yellow-900">
            
                Overview
            </nuxt-link>

            <div class="flex">
                <button
                 @click="togglePaymentDialog()"
                class="mt-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#cf2525] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Enroll Now
                </button>
            </div>
        </div>
    </div>
    <PaymentDialog
    v-if="ispaymentDiaglogOpen"
    :open="ispaymentDiaglogOpen"
    @update:open="(open) => ispaymentDiaglogOpen = open"
    :course="course"
    />
</div>
</template>
<style scoped>
.total-students{
  position: absolute;
  width: 100%;
  justify-content: center
}
</style>