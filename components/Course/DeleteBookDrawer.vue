<script lang="ts" setup>
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from '@/components/ui/alert-dialog'

const emit = defineEmits(["refresh-data", "update:open"]);
const props = defineProps<{ open: boolean; course?: CourseProps }>();
const closeDialog = () => emit("update:open", false);
const { deleteCourse } = courseAsync();
const removeCourse = async () => {
  await deleteCourse(props?.course?.id)
  closeDialog();
};

console.log(props)
</script>



<template>
  <AlertDialog
  :open="open"
  @update:open="(openState) => $emit('update:open', openState)">
    <AlertDialogTrigger></AlertDialogTrigger>
    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
        <AlertDialogDescription>
          This action cannot be undone. This will permanently delete your account
          and remove your data from our servers.
        </AlertDialogDescription>
      </AlertDialogHeader>
      <AlertDialogFooter>
        <AlertDialogAction class="bg-red-500">Cancel</AlertDialogAction>
        <AlertDialogAction @click="removeCourse">Continue</AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>