<script setup lang="ts">
import type { PaymentProps, CourseProps } from "@/utils/types";
import { h, ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion'
import { toTypedSchema } from '@vee-validate/zod'
import { z } from 'zod'
import { useForm } from 'vee-validate'
import { TagsInput, TagsInputInput, TagsInputItem, TagsInputItemDelete, TagsInputItemText } from '@/components/ui/tags-input'
import { toast } from '@/components/ui/toast'
import { useToast } from '@/components/ui/toast/use-toast'
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Separator } from '@/components/ui/separator'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogScrollContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'

const isLoading = ref(true);
const emit = defineEmits(["refresh-data", "update:open"]);
const props = defineProps<{ open: boolean; course?: CourseProps }>();
const closeDialog = () => emit("update:open", false);
const router = useRouter();
const { register } = useAuth();
const { toast } = useToast()
const tags: Ref<any> = ref([]);
const current_course = ref<any>({});
const value = ref({
    id : props.course?.id,
    photo: null,
}) 

const value1 = ref({
    id : props.course?.id,
    photo: null,
}) 


const handleFileChange = async (e: any) => {
    value.value.photo = e.target?.files?.[0];
    
    const formData = new FormData();

    Object.keys(value.value).forEach((key) => {
      formData.append(key, value.value[key]);
    });

    const resp = await $larafetch(`${useRuntimeConfig().public.backendUrl}/api/internship_photo`, {
     method: "POST",
     body: formData,
   });


    if(resp){
        emit("refresh-data");
        toast({
            title: 'Success!',
            description: 'Photo have been updated',
        });
        await refresh()
 
    }
};

const handleFileChange1 = async (e: any) => {

    value1.value.photo = e.target?.files?.[0];
    
    const formData = new FormData();

    Object.keys(value1.value).forEach((key) => {
      formData.append(key, value1.value[key]);
    });

    const resp = await $larafetch(`${useRuntimeConfig().public.backendUrl}/api/training_photo`, {
     method: "POST",
     body: formData,
   });


   if(resp){
    emit("refresh-data");
        toast({
            title: 'Success!',
            description: 'Photo have been updated',
    });
    await refresh()
     
   }
};

async function refresh() {
    try {
        await fetchCurrentCourse();
    } catch {
        current_course.value = null;
    }
}

const fetchCurrentCourse = async () => {
    try {
        const response = await $fetch<{ course: CourseProps[] }>(
     `${useRuntimeConfig().public.backendUrl}/api/current_course/`+props.course?.id
        );
    current_course.value = response.data;
  } catch (error: any) {
    if ([401, 419].includes(error?.response?.status)) return null;
    throw error;
  }
}

const formSchema = toTypedSchema(z.object({
  training_lesson: z.array(z.string()).min(1).max(5),
  section1: z.array(z.string()).min(1).max(5),
  section2: z.array(z.string()).min(1).max(5),
}))
const { handleSubmit } = useForm({
  validationSchema: formSchema,
  initialValues: {
    training_lesson: props.course?.course_internship?.lesson_training || [],
    section1: props.course?.course_training?.what_will_learn || [],
    section2: props.course?.course_training?.training_process || [],
  },
})

const onSubmit =  handleSubmit( async (values)  =>  {
    const { training_lesson, section1, section2 } = values;
    const data = {
        id: value?.value.id,
        lesson_training: training_lesson,
        what_will_learn: section1,
        training_process: section2
    }
    try {

    const resp = await $larafetch(`${useRuntimeConfig().public.backendUrl}/api/training_internship`, {
        method: "POST",
        body: JSON.stringify(data, null, 2),
    });

    if(resp){
        emit("refresh-data");
        toast({
            title: 'Success!',
            description: 'Course have been updated',
        });
        await refresh()
    
    }
    } catch (error) {
    console.log(error);
    } 

})

// const {
//   submit,
//   inProgress,
//   validationErrors: errors,
// } = useSubmit(() => register(data), {
//   onSuccess: () => router.push("/dashboard"),
// });.

onBeforeMount(async () => {
    await fetchCurrentCourse();
    isLoading.value = false;
})

</script>

<template>
    <div v-if="isLoading">Loading...</div>
    <div v-else>
        <Dialog 
        :open="open"
        @update:open="(openState) => $emit('update:open', openState)">
          <DialogTrigger as-child>
          </DialogTrigger>
          <DialogScrollContent  class="sm:max-w-6xl max-w-[425px]"">
            <DialogHeader class="p-6 pb-0">
              <DialogTitle>Course Details</DialogTitle>
              <p></p>
              <DialogDescription>
                
              </DialogDescription>
            </DialogHeader>
            <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
              <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                  <div class="mt-6 sm:mt-8 items-center">
                      <div class="flex justify-center"><img class="rounded-t-lg " :src="`${useRuntimeConfig().public.backendUrl}/images/${course.profile_picture}`" alt="" /></div> 
                      <p class="font-bold text-black">Course Title <span class="text-gray-500">|</span><span class="text-red-700">&nbsp;{{course?.course_offer}}</span></p><br>
                      <p class="font-bold text-black">Course Description <span class="text-gray-500">|</span><span class="text-red-700">&nbsp;{{course?.description}}</span></p><br>
                      <p class="font-bold text-black">Course Price <span class="text-gray-500">|</span><span class="text-red-700">&nbsp;{{course?.price_after}}</span></p><br>
                      <p class="font-bold text-black">Featured <span class="text-gray-500">|</span><span class="text-red-700">&nbsp;{{ course?.is_featured === 0 ? 'No' : 'Yes'}}</span></p>
                    
                      <br />
                      <br />
      
                      <Separator label="others" class="font-extrabold" />
      
                      <Accordion class="w-full" type="single" default-value="item-1" >
                          <AccordionItem value="">
                              <AccordionTrigger class="font-bold">Lesson and Internship Section</AccordionTrigger>
                                  <AccordionContent>
                                      <div class="grid sm:grid-cols-2 gap-2">
                                          <div>
                                              <div class="flex justify-center">
                                                  <img class="rounded-t-lg w-48" :src="`${useRuntimeConfig().public.backendUrl}/internship/${current_course?.course_internship?.profile_picture}`" alt="" />
                                              </div> 
                                          </div>
                                          <div>
                                              <Input
                                                  type="file"
                                                  @change="handleFileChange"
                                                  id="profile_picture"
                                                  class="col-span-3"
                                                  icon="i-heroicons-folder"
                                                  required
                                              />
                                              <!-- <UInput type="file"  @change="handleFileChange" accept="image/*, .heic, .heif" size="sm" icon="i-heroicons-folder" class="w-2/3" /> -->
                                                  <br />
                                              <form class="w-2/3 space-y-6" @submit="onSubmit">
                                                  <FormField v-slot="{ value }" name="training_lesson">
                                                  <FormItem>
                                                      <FormLabel>Duration of lesson and internship</FormLabel>
                                                      <FormControl>
                                                      <TagsInput :model-value="value">
                                                          <TagsInputItem v-for="item in value" :key="item" :value="item">
                                                          <TagsInputItemText />
                                                          <TagsInputItemDelete />
                                                          </TagsInputItem>
                                              
                                                          <TagsInputInput placeholder="..." />
                                                      </TagsInput>
                                                      </FormControl>
                                                      <FormDescription>
                                                      Type and Press Enter
                                                      </FormDescription>
                                                      <FormMessage />
                                                  </FormItem>
                                                  </FormField>
                                 
                                              </form>
                                              <br />
                                          </div>
                                      </div>
                              </AccordionContent>
                          </AccordionItem>
                          <AccordionItem  value="">
                              <AccordionTrigger  class="font-bold">Training Process and What they will learn Section</AccordionTrigger>
                              <AccordionContent>
                                  <div class="grid sm:grid-cols-2 gap-2">
                                      <div>
                                        
                                          <div class="flex justify-center">
                                              <img class="rounded-t-lg w-48" :src="`${useRuntimeConfig().public.backendUrl}/training/${current_course?.course_training?.profile_picture}`" alt="" />
                                          </div> 
                                      </div>
                                      <div>
                                          <Input
                                                  type="file"
                                                  @change="handleFileChange1"
                                                  id="profile_picture"
                                                  class="col-span-3"
                                                  icon="i-heroicons-folder"
                                                  required
                                              />
                                          <br />
                                          <form class="w-2/3 space-y-6" @submit="onSubmit">
                                              <FormField v-slot="{ value }" name="section1">
                                              <FormItem>
                                                  <FormLabel>What they will learn</FormLabel>
                                                  <FormControl>
                                                  <TagsInput :model-value="value">
                                                      <TagsInputItem v-for="item in value" :key="item" :value="item">
                                                      <TagsInputItemText />
                                                      <TagsInputItemDelete />
                                                      </TagsInputItem>
                                          
                                                      <TagsInputInput placeholder="how to analyze charts
      " />
                                                  </TagsInput>
                                                  </FormControl>
                                                  <FormDescription>
                                                  Type and Press Enter
                                                  </FormDescription>
                                                  <FormMessage />
                                              </FormItem>
                                              </FormField>
                                              <FormField v-slot="{ value }" name="section2">
                                                  <FormItem>
                                                      <FormLabel>Training Process</FormLabel>
                                                      <FormControl>
                                                      <TagsInput :model-value="value">
                                                          <TagsInputItem v-for="item in value" :key="item" :value="item">
                                                          <TagsInputItemText />
                                                          <TagsInputItemDelete />
                                                          </TagsInputItem>
                                              
                                                          <TagsInputInput placeholder="Job hunting" />
                                                      </TagsInput>
                                                      </FormControl>
                                                      <FormDescription>
                                                      Type and Press Enter
                                                      </FormDescription>
                                                      <FormMessage />
                                                  </FormItem>
                                                  </FormField>
                                              <Button type="submit">
                                              Submit
                                              </Button>
                                          </form>
                                          <br />
                                      </div>
                                  </div>
                              </AccordionContent>
                              </AccordionItem>
                      </Accordion>    
                  </div>
                </div>
              </div>
            </section>
          </DialogScrollContent>
        </Dialog>
    </div>
  
</template>