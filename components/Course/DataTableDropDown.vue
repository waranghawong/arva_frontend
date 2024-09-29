<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Button } from '@/components/ui/button'
import type { CourseProps } from "@/utils/types";

const courses = defineProps<{
  courses: {
    course: CourseProps | null | undefined;
  }
}>()
const isLoading = ref(false);
const isBookDrawerOpen = ref(false);
const isDeleteBookDialogOpen = ref(false);
const isCourseDetailsDialogOpen = ref(false);
const currentCourse = ref<CourseProps>();

const toggleDeleteDialog = (course: CourseProps) => {
  isDeleteBookDialogOpen.value = !isDeleteBookDialogOpen.value;
  currentCourse.value = course;
};

const toggleEditBookDrawer = (course: CourseProps) => {
  isBookDrawerOpen.value = !isBookDrawerOpen.value;
  currentCourse.value = course;


};

const openCourseDetailsDialog = (course: CourseProps) => {
  isCourseDetailsDialogOpen.value = !isCourseDetailsDialogOpen.value;
  currentCourse.value = course;
}



const toggleMakeFeatureDialog = async (course: CourseProps) => {
  await $larafetch(`/api/course/${course.id}/make_feature`, { 
        method: "put",
        body: course,
        headers: {
          Accept: "application/json",
        },
  });
}

const getCourse = async () => {
  try {
   
  } catch (error) {
    console.log(error);
  } finally {
    isLoading.value = false;
  }
};


</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="w-8 h-8 p-0">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="w-4 h-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuLabel>Actions</DropdownMenuLabel>
      <DropdownMenuItem @click="openCourseDetailsDialog(courses?.courses)">
        View course details
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem @click="toggleEditBookDrawer(courses?.courses)">Edit</DropdownMenuItem>
      <DropdownMenuItem @click="toggleMakeFeatureDialog(courses?.courses)">Feature Course</DropdownMenuItem>
      <DropdownMenuItem @click="toggleDeleteDialog(courses?.courses)" variant="destructive" class="text-red-600 font-bold hover:bg-red">Delete</DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
    <CourseDeleteBookDrawer
    v-if="isDeleteBookDialogOpen"
    :open="isDeleteBookDialogOpen"
    @update:open="(open: boolean) => isDeleteBookDialogOpen = open"
    :course="currentCourse"
  />
    <CourseNew 
    v-if="isBookDrawerOpen"
    :open="isBookDrawerOpen"
    @update:open="(open: boolean) => isBookDrawerOpen = open"
    :course="currentCourse"
    />

    <CourseDialog
    v-if="isCourseDetailsDialogOpen"
    :open="isCourseDetailsDialogOpen"
    @update:open="(open: boolean) => isCourseDetailsDialogOpen = open"
    :course="currentCourse"
    />
  
</template>