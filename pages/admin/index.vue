<script setup lang="ts">
const { user, logout } = useAuth();
definePageMeta({ middleware: ["auth"] });


</script>

<template>
    <NuxtLayout name="main">
        <Head>
        <Title>Ancient Rusher VA</Title>
        </Head>
        <div class="grid w-full gap-4">
            <header class="flex item-start justify-between">
                <div class="grow">
                    <h1>Dashboard</h1>
                </div>
                <button type="button" @click="logout" class="h-[36px] px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Logout</button>
       
            </header>
        
            <main class="grid gap-4">
                <div class="flex items-center gap-4">
                    <div v-for="(item, index) in 3" :key="index" class="w-[120px] h-[36px] bg-neutral-200">
                        
                    </div>
                    
                </div>
                <section>
                    <div class="w-full h-[360px] bg-neutral-200">
                        ARVA DASHBOARD
                    </div>
                </section>
            </main>
            <footer>
                <div class="grid lg:grid-cols-3 gap-4">
                    <!-- <Card v-for='(item, index) in cards' :key='index' :card="item" >

                    </Card> -->
                </div>
            </footer>
        </div>
  


    </NuxtLayout>
</template>