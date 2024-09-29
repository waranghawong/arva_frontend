import { h } from 'vue'
import type {
  ColumnDef,
} from '@tanstack/vue-table'
import DropdownAction from '@/components/Course/DataTableDropDown.vue'
import '@fortawesome/fontawesome-free/css/all.min.css';
import { ArrowUpDown, ChevronDown } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import type { CourseProps } from "@/utils/types"

export const columns: ColumnDef<CourseProps>[] = [
  {
    accessorKey: 'id',
    header: () => h('div', { class: 'text-left' }, 'ID'),
    cell: ({ row }) => {
      const id = row.getValue('id')
      return h('div', { class: 'text-left font-medium' }, id)
    },
  },
  {
    accessorKey: 'profile_picture',
    header: () => h('div', { class: 'text-left' }, 'Profile Picture'),
    cell: ({ row }) => {
      const profile_picture = row.getValue('profile_picture')
      return  [
        h('img', {
          src: `${useRuntimeConfig().public.backendUrl}/images/${profile_picture}`, // image URL
          alt: 'Course From Image',
          width: 100, // optional
          height: 100, // optional
        }),
      ]
    },
  },
  {
    accessorKey: 'instructor_name',
    header: ({ column }) => {
        return h(Button, {
            variant: 'ghost',
            onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        }, () => ['Instructor Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: 'lowercase' }, row.getValue('instructor_name')),
},
  {
    accessorKey: 'course_offer',
    header: () => h('div', { class: 'text-left' }, 'Course Offer'),
    cell: ({ row }) => {
      const course_offer = row.getValue('course_offer')
      return h('div', { class: 'text-left font-medium' }, course_offer)
    },
  },
  {
    accessorKey: 'description',
    header: () => h('div', { class: 'text-left' }, 'Description'),
    cell: ({ row }) => {
      const description = row.getValue('description')
      return h('div', { class: 'text-left font-medium' }, description)
    },
  },

  {
    accessorKey: 'course_to',
    header: () => h('div', { class: 'text-left' }, 'Course To'),
    cell: ({ row }) => {
      const course_to = new Date(row.getValue('course_to'))

      const month = course_to.toLocaleString('default', { month: 'long' });
      const day = course_to.getDate();
      const year = course_to.getFullYear();

      const formattedDateFrom = `${month} ${day} ${year}`;

      return h('div', { class: 'text-left font-medium' }, formattedDateFrom)
    },
  },
 
  {
    accessorKey: 'course_from',
    header: () => h('div', { class: 'text-left' }, 'Course From'),
    cell: ({ row }) => {
      const course_from = new Date(row.getValue('course_from'))

      const month = course_from.toLocaleString('default', { month: 'long' });
      const day = course_from.getDate();
      const year = course_from.getFullYear();

      const formattedDateFrom = `${month} ${day} ${year}`;

      return formattedDateFrom
    },
  },
  {
    accessorKey: 'is_featured',
    header: () => h('div', { class: 'text-left' }, 'Is Featured'),
    cell: ({ row }) => {
      const is_featured = Number.parseFloat(row.getValue('is_featured'))
      const formatted = is_featured === 1 ? (
        '✔' // HTML entity for checkmark symbol
      ) : (
        '✖' // HTML entity for cross symbol
      );
  
      return h('div', { class: 'text-right text-red-700 font-medium' }, formatted)
    },
  },
  {
    id: 'actions',
    enableHiding: false,
    header: () => h('div', { class: 'text-left' }, 'Actions'),
    cell: ({ row }) => {
      const courses = row.original

      return h('div', { class: 'relative' }, h(DropdownAction, {
        courses,
      }))
    },
  },
]