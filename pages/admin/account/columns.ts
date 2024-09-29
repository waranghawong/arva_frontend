import { h } from 'vue'
import DropdownAction from '@/components/Course/DataTableDropDown.vue'

export const columns: ColumnDef<Users>[] = [
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
    header: () => h('div', { class: 'text-left' }, 'Name'),
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
    accessorKey: 'role',
    header: () => h('div', { class: 'text-left' }, 'Role'),
    cell: ({ row }) => {
      const role = row.getValue('role')
      return h('div', { class: 'text-left font-medium' }, role)
    },
  },
  {
    accessorKey: 'created_at',
    header: () => h('div', { class: 'text-left' }, 'Created At'),
    cell: ({ row }) => {
      const created_at = new Date(row.getValue('created_at')) 

      const month = created_at.toLocaleString('default', { month: 'long' });
      const day = created_at.getDate();
      const year = created_at.getFullYear();

      const formattedDateFrom = `${month} ${day} ${year}`;
      return h('div', { class: 'text-left font-medium' }, formattedDateFrom)
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