<script setup lang="ts">
import { h, onMounted, ref } from 'vue';
import { columns } from './columns';
import type { PaymentProps } from "@/utils/types";

definePageMeta({ middleware: ["auth"] });
const { fetchPayments } = paymentAsync();
const { user, logout } = useAuth();

const router = useRouter();

const data = ref<any>([]);

const isLoading = ref(false);
const books = ref<PaymentProps[]>([]);
const currentBook = ref<PaymentProps>();

const isBookDrawerOpen = ref(false);
const isDeleteBookDialogOpen = ref(false);

const toggleAddBookDrawer = () => {
  isBookDrawerOpen.value = !isBookDrawerOpen.value;
};

const toggleEditBookDrawer = (book: PaymentProps) => {
  currentBook.value = book;
  isBookDrawerOpen.value = !isBookDrawerOpen.value;
};

const toggleDeleteDialog = (book: PaymentProps) => {
  currentBook.value = book;
  isDeleteBookDialogOpen.value = !isDeleteBookDialogOpen.value;
};

data.value = await fetchPayments();


onMounted(() => (
    data.value = fetchPayments()
))

</script>

<template>
    <NuxtLayout name="main">
        <Head>
        <Title>Ancient Rusher VA</Title>
        </Head>
        <div class="grid w-full gap-4">
            <header class="flex item-start justify-between">
                <div class="grow">
                    <p>All Payments</p>
                    <h1>Payments</h1>
                </div>
                <button type="button" @click="logout" class="h-[36px] px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Logout</button>
       
            </header>
            <div class="flex justify-end mr-32">
            </div>
            <div class="container py-10 mx-auto">
                <PaymentsDataTable :columns="columns" :data="data.payments" @refresh-data="fetchPayments()" />
            </div>
        
            <!-- <main class="grid gap-4">
                <div class="flex items-center gap-4">
                    <div v-for="(item, index) in 3" :key="index" class="w-[120px] h-[36px] bg-neutral-200">
                        
                    </div>
                    <div class="content-end bg-neutral-200">
                        add
                    </div>
                </div>
                <section>
                    <div class="w-full h-[360px] bg-neutral-200">
                        
                    </div>
                </section>
            </main>
            <footer>
                <div class="grid lg:grid-cols-3 gap-4">
                    <Card v-for='(item, index) in cards' :key='index' :card="item" >

                    </Card>
                </div>
                footer section
            </footer> -->
        </div>
  


    </NuxtLayout>
</template>