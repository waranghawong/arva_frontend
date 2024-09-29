<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { useToast } from '@/components/ui/toast/use-toast'
import {
  Sheet,
  SheetContent,
  SheetDescription,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from '@/components/ui/sheet'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { type Ref, ref } from 'vue'
import {
  CalendarDate,
  DateFormatter,
  getLocalTimeZone,
} from '@internationalized/date'

import { Calendar as CalendarIcon } from 'lucide-vue-next'
import type { DateRange } from 'radix-vue'
import { RangeCalendar } from '@/components/ui/range-calendar'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { cn } from '@/lib/utils'
import type { CourseProps } from "@/utils/types"

type PickedProps = "instructor_name" | "course_offer" | "description" | "price_before" | "price_after"| "course_from"| "course_to";

const { toast } = useToast()

interface CustomCourseProps extends Pick<CourseProps, PickedProps> {
  profile_picture?: string;
}
const { insertCourse, updateCourse } = courseAsync();
const props = defineProps<{ open: boolean; course?: CourseProps }>();
const emit = defineEmits(["update:open", "refresh-data"]);

const router = useRouter();
const value = ref({
  start: new CalendarDate(2024, 9, 20),
  end: new CalendarDate(2024, 9, 20).add({ days: 20 }),
}) as Ref<DateRange>

const formatDate = (dateObject: any) => {
  let year = dateObject.year;
  let month = dateObject.month;
  let day = dateObject.day;

  // Format the month as a two-digit string
  let monthStr = (month < 10) ? "0" + month.toString() : month.toString();

  // Construct the formatted date string
  let formattedDate = year + "-" + monthStr + "-" + day;

  return formattedDate;
}

let form = reactive<CustomCourseProps>({
  instructor_name: "",
  course_offer: "",
  description: "",
  price_before: "",
  price_after: "",
  course_from: formatDate(value.value.start),
  course_to: formatDate(value.value.end),
  profile_picture: undefined,
});

const onFileChange = async (e: any) => {
  form.profile_picture = e.target.files[0];
};

const isSubmitting = ref(false);

const editBook = async () => {
 try {
   isSubmitting.value = true;
   const formData = new FormData();
    Object.keys(form).forEach((key) => {
      formData.append(key, form[key]);
    });
    
   const resp = await $larafetch(`${useRuntimeConfig().public.backendUrl}/api/update_course`, {
     method: "POST",
     body: formData,
   });
   closeDrawer(false);
   emit("refresh-data");
   toast({
      title: 'Success!',
      description: 'Course have been updated',
    });
  //  location.reload()
 } catch (error) {
   console.log(error);
 } finally {
   isSubmitting.value = false;
 }
};


const { submit, inProgress, validationErrors: errors } = useSubmit(
  async () => {
    const formData = new FormData();
    Object.keys(form).forEach((key) => {
      formData.append(key, form[key]);
    });

      const result = await insertCourse(formData);
    
    return result;
  },
  {
    onSuccess: (result) => {
      toast({
        title: 'Success!',
        description: 'New course have been added',
      });
      location.reload()
    },
  }
);



const closeDrawer = (openState: boolean) => emit("update:open", openState);

const df = new DateFormatter('en-US', {
  year: 'numeric',
  month: '2-digit',
  day: '2-digit',
})


const startDate = computed(() => value.value.start);
const endDate = computed(() => value.value.end);

onMounted(() => {
  if (props.course) {
    form = props.course;
  }
});


</script>

<template>
  <Sheet :open="open" @update:open="closeDrawer">
    <form >
    <SheetContent class="w-full bg-white">
      <SheetHeader>
        <SheetTitle>
          <template v-if="course"> Edit Course </template>
          <template v-else>Add New Course</template>
        </SheetTitle>
        <SheetDescription>
          Make changes to course. Click save when you're done.
        </SheetDescription>
      </SheetHeader>
      <div class="grid gap-4 py-4">
   
        <div class="grid grid-cols-4 items-center gap-4">
          <Label for="instructor_name" class="text-right"> Instructor Name</Label>
          <Input
            v-model:model-value="form.instructor_name"
            type="text"
            id="instructor_name"
            class="col-span-3"
            required
          />
        </div>
        <div class="grid grid-cols-4 items-center gap-4">
          <Label for="course_offer" class="text-right"> Course Offer </Label>
          <Input
            v-model:model-value="form.course_offer"
            type="text"
            id="author"
            class="col-span-3"
            required
          />
        </div>
        <div class="grid grid-cols-4 items-center gap-4">
          <Label for="description" class="text-right"> Description </Label>
          <Textarea
            v-model:model-value="form.description"
            type="text"
            id="isbn"
            class="col-span-3"
            required
          />
        </div>
        <div class="grid grid-cols-4 items-center gap-4">
          <Label for="price_before" class="text-right">
            Price before
          </Label>
          <Input
            v-model:model-value="form.price_before"
            type="number"
            id="price_before"
            class="col-span-3"
            required
          />
        </div>
        <div class="grid grid-cols-4 items-center gap-4">
          <Label for="price_after" class="text-right">
            Price after
          </Label>
          <Input
            v-model:model-value="form.price_after"
            type="number"
            id="price_after"
            class="col-span-3"
            required
          />
        </div>
        <div class="grid grid-cols-4 items-center gap-4">
          <Label for="price_after" class="text-right">
            Course date
          </Label>
          <Popover> 
            <PopoverTrigger as-child>
              <Button
                variant="outline"
                :class="cn(
                  'w-[280px] justify-start text-left font-normal',
                  !value && 'text-muted-foreground',
                )"
              >
                <CalendarIcon class="mr-2 h-4 w-4" />
                <template v-if="value.start">
                  <template v-if="value.end">
                    {{ df.format(value.start.toDate(getLocalTimeZone())) }} - {{ df.format(value.end.toDate(getLocalTimeZone())) }}
                  </template>
        
                  <template v-else>
                    {{ df.format(value.start.toDate(getLocalTimeZone())) }}
                  </template>
                </template>
                <template v-else>
                  Pick a date
                </template>
              </Button>
      
            </PopoverTrigger>
            <PopoverContent class="w-auto p-0">
              <RangeCalendar v-model="value" initial-focus :number-of-months="2" @update:start-value="(startDate) => value.start = startDate" />
            </PopoverContent>
            
          </Popover>
        
        </div>
        <div class="grid grid-cols-4 items-center gap-4">
        
          <Label for="profile_picture" class="text-right"> Profile Picture </Label>
 
          <Input
            type="file"
            @change="onFileChange"
            id="profile_picture"
            class="col-span-3"
            required
          />
        </div>

      </div>
      <SheetFooter>
        <Button  type="submit"
        @click="() => (course?.id ? editBook() : submit())"
        >
          <template v-if="inProgress">Saving...</template>
          <template v-else> Save changes </template>
        </Button>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.instructor_name">*{{errors.instructor_name[0]}}</small>
        </p>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.course_from">*{{errors.course_from[0]}}</small>
        </p>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.course_from">*{{errors.course_to[0]}}</small>
        </p>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.course_offer">*{{errors.course_offer[0]}}</small>
        </p>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.price_before">*{{errors.price_before[0]}}</small>
        </p>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.price_before">*{{errors.price_after[0]}}</small>
        </p>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.profile_picture">*{{errors.profile_picture[0]}}</small>
        </p>
        <p>
          <small class="text-red-700 text-xs" v-if="errors.description">*{{errors.description[0]}}</small>
        </p>
      
      </SheetFooter>
    </SheetContent>
  </form>

  </Sheet>

</template>