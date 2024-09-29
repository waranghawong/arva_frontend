<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Button } from '@/components/ui/button'
import type { PaymentProps } from "@/utils/types";

const { fetchPayments } = paymentAsync();
const payments = defineProps<{
  payments: {
    payments: PaymentProps | null | undefined;
  }
}>()
const isLoading = ref(false);

const emit = defineEmits(["acceptPayment"]);

const  CancelPayment = async (payment: PaymentProps) => {
  await $larafetch(`/api/payment/${payment.id}/status`, { 
        method: "put",
        body: payment,
        headers: {
          Accept: "application/json",
        },
  });
};

const AcceptPayment = async (payment: PaymentProps) => {
  await $larafetch(`/api/payment/${payment.id}/status`, { 
        method: "put",
        body: payment,
        headers: {
          Accept: "application/json",
        },
  });
}


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
      <DropdownMenuItem :disabled="payments?.payments?.status == 'accepted'" @click="AcceptPayment(payments?.payments)">
        Accept Payment
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem @click="CancelPayment(payments?.payments)">Cancel Payment</DropdownMenuItem>
      <!-- <DropdownMenuItem @click="toggleDeleteDialog(payments?.payments)" variant="destructive">Delete</DropdownMenuItem> -->
    </DropdownMenuContent>
  </DropdownMenu>
  
</template>