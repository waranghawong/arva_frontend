import { h } from 'vue'
import DropdownAction from '@/components/payments/DataTableDropDown.vue'
import { defineEmits } from 'vue'

const emit = defineEmits(["refreshData"]);

export const columns: ColumnDef<Payments>[] = [
  {
    accessorKey: 'id',
    header: () => h('div', { class: 'text-left' }, 'ID'),
    cell: ({ row }) => {
      const id = row.getValue('id')
      return h('div', { class: 'text-left font-medium' }, id)
    },
  },
  {
    id: 'first_name',
    accessorKey: 'first_name',
    header: () => h('div', { class: 'text-left' }, ''),
    cell: ({ row }) => {
       h('div', { class: 'text-left font-medium' }, row.getValue('first_name'))
    },
  },
  {
    id: 'middle_name',
    accessorKey: 'middle_name',
    header: () => h('div', { class: 'text-left' }, ''),
    cell: ({ row }) => {
       h('div', { class: 'text-left font-medium' }, row.getValue('middle_name'))
    },
  },
  {
    id: 'last_name',
    accessorKey: 'last_name',
    header: () => h('div', { class: 'text-left' }, ''),
    cell: ({ row }) => {
       h('div', { class: 'text-left font-medium' }, row.getValue('last_name'))
    },
  },
  {
    id: 'full_name',
    accessorKey: 'full_name',
    header: () => h('div', { class: 'text-left' }, 'Full Name'),
    cell: ({ row }) => {
      const first_name = row.getValue('first_name')
      const middle_name = row.getValue('middle_name')
      const last_name = row.getValue('last_name')
      let fullName = first_name
      if (middle_name) {
        fullName += ` ${middle_name}`
      }
      if (last_name) {
        fullName += ` ${last_name}`
      }
      return h('div', { class: 'text-left font-medium' }, fullName)
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
    accessorKey: 'contact_number',
    header: () => h('div', { class: 'text-left' }, 'Contact Number'),
    cell: ({ row }) => {
      const contact_number = row.getValue('contact_number')
      return contact_number
    },
  },
  {
    accessorKey: 'reference_number',
    header: () => h('div', { class: 'text-left' }, 'Reference Number'),
    cell: ({ row }) => {
      const reference_number = row.getValue('reference_number')
      return reference_number
    },
  },
  {
    accessorKey: 'status',
    header: () => h('div', { class: 'text-left' }, 'Status'),
    cell: ({ row }) => {
      const status = row.getValue('status')
      if(status == 'pending'){
        return h('div', { class: 'text-left text-red-700 font-bold' }, status.toUpperCase())
      }
      else{
        return h('div', { class: 'text-left text-green-700 font-bold' }, status.toUpperCase())
      }
    
    },
  },

  {
    id: 'actions',
    enableHiding: false,
    header: () => h('div', { class: 'text-left' }, 'Actions'),
    cell: ({ row }) => {
      const payments = row.original

      return h('div', { class: 'relative' }, h(DropdownAction, {
        payments,
        onAcceptPayment: (payment) => {
          // Call the acceptPayment function in the DropdownAction component
          acceptPayment(payment)
        },
      }))
    },
  },
]