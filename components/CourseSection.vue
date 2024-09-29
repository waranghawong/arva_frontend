<script setup>
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
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
    <div>
        <section :id="`${course.section_id}`">
            <div class="flex justify-center mt-24">
                <!-- <p class="font-extrabold text-black text-1xl sm:text-2xl lg:text-3xl">{{course.course_offer}}</p> -->
            </div>
            <div class="gap-8 py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
                <img class="rounded-t-lg border" :src="`${useRuntimeConfig().public.backendUrl}/images/${course.profile_picture}`" alt="" />
                <div class="mt-4 md:mt-0 ">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{course.course_offer}}</h2>
                    <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400"> {{ course.description }}</p>
                    <button
                    @click="togglePaymentDialog()"
                        class="mt-8 inline-flex items-center px-3 py-2 text-lg font-medium text-center text-white bg-[#cf2525] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                       Enroll Now
                   </button>
                </div>
            </div>
        </section>
        <PaymentDialog
        v-if="ispaymentDiaglogOpen"
        :open="ispaymentDiaglogOpen"
        @update:open="(open) => ispaymentDiaglogOpen = open"
        :course="course"
        />
    </div>
</template>