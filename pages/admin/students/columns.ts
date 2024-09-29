import { h } from 'vue'
import DropdownAction from '@/components/Course/DataTableDropDown.vue'

export const columns: ColumnDef<Students>[] = [
  {
    accessorKey: 'id',
    header: () => h('div', { class: 'text-left' }, 'ID'),
    cell: ({ row }) => {
      const id = row.getValue('id')
      return h('div', { class: 'text-left font-medium' }, id)
    },
  },
  {
    accessorKey: 'name',
    header: () => h('div', { class: 'text-left' }, 'Full Name'),
    cell: ({ row }) => {
      const name = row.getValue('name')
      return h('div', { class: 'text-left font-medium' }, name)
    },
  },
  {
    accessorKey: 'email',
    header: () => h('div', { class: 'text-left' }, 'Email'),
    cell: ({ row }) => {
      const email = row.getValue('email')
      return h('div', { class: 'text-left font-medium' }, email)
    },
  },
  {
    accessorKey: 'haspayment',
    header: () => h('div', { class: 'text-left' }, 'Course'),
    cell: ({ row }) => {
      const courseOffer = row.getValue('haspayment').course.course_offer
      return h('div', { class: 'text-left font-medium' }, courseOffer)
    },
  },
  {
    id: 'course_from',
    accessorKey: 'course_from',
    header: () => h('div', { class: 'text-left' }, ''),
    cell: ({ row }) => {
       h('div', { class: 'text-left font-medium' }, row.getValue('first_name'))
    },
  },
  {
    id: 'course_to',
    accessorKey: 'course_to',
    header: () => h('div', { class: 'text-left' }, ''),
    cell: ({ row }) => {
       h('div', { class: 'text-left font-medium' }, row.getValue('middle_name'))
    },
  },
  {
    id: 'haspayment',
    accessorKey: 'full_name',
    header: () => h('div', { class: 'text-left' }, 'Schedule'),
    cell: ({ row }) => {
      const from = new Date(row.getValue('haspayment').course.course_from)
      const to = new Date(row.getValue('haspayment').course.course_to)

      function convertDate(dates){
        const month = from.toLocaleString('default', { month: 'long' });
        const day = from.getDate();
        const year = from.getFullYear();
  
        const formattedDateFrom = `${month} ${day} ${year}`;

        return formattedDateFrom;
      }
 
      return h('div', { class: 'text-left font-medium' }, `${convertDate(from)} - ${convertDate(to)}`)
    },
  },
  {
    accessorKey: 'haspayment',
    header: () => h('div', { class: 'text-left' }, 'Instructor'),
    cell: ({ row }) => {
      const instructor = row.getValue('haspayment').course.instructor_name
      return h('div', { class: 'text-left font-medium' }, instructor)
    },
  },

  // {
  //   id: 'actions',
  //   enableHiding: false,
  //   header: () => h('div', { class: 'text-left' }, 'Actions'),
  //   cell: ({ row }) => {
  //     const courses = row.original

  //     return h('div', { class: 'relative' }, h(DropdownAction, {
  //       courses,
  //     }))
  //   },
  // },
]