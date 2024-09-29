<script setup>
const loading  = ref(false)
const items = ref ([
    { 
        title: 'Dashboard',
        path: '/admin',
        icon: 'material-symbols:dashboard'
    },
    { 
        title: 'Courses',
        path: '/admin/courses',
        icon: 'arcticons:canvasstudent'
    },
    { 
        title: 'Payments',
        path: '/admin/payments',
        icon: 'fluent-mdl2:money'
    },
    { 
        title: 'Students',
        path: '/admin/students',
        icon: 'fluent-emoji-high-contrast:student'
    },
    { 
        title: 'Account',
        path: '/admin/account',
        icon: 'ic:sharp-account-circle'
    },
])
</script>
<template>
    <div>
        <header class="header flex items-center gap-2 hover:scale-[101%] transition cursor-pointer">
            <Logo class="w-32"/>
            <p class="font-bold text-black">Ancient Rusher VA</p>
        </header>
        <div class="px-4 grow mt-12">
            <div class="grid gap-2">
                <NuxtLink :to="''+item.path" v-for='(item, index) in items' :key='index' class="flex items-center gap-2 px-2 py-1 transition rounded cursor-pointer hover:bg-neutral-100">
                    <Icon size="20" :name="item.icon" />
                    <span> {{ item.title}} </span>
                </NuxtLink>
            </div>
        </div>
    </div>
</template>