<template>
    <q-layout view="hHh LpR lFr">
        <q-header
            :style="tenantStyles"
            class="bg-primary text-white"
            elevated
            reveal
        >
            <q-toolbar>
                <q-btn
                    color="dark"
                    dense
                    flat
                    icon="menu"
                    round
                    @click="toggleLeftDrawer"
                />

                <q-toolbar-title>
                    <q-avatar v-if="tenantLogo">
                        <img :src="tenantLogo" alt="Logo Image" />
                    </q-avatar>
                    {{ $page.props.tenant_name ?? 'Ed Driving' }}
                </q-toolbar-title>

                <q-btn
                    color="dark"
                    dense
                    flat
                    icon="menu"
                    round
                    @click="toggleRightDrawer"
                />
            </q-toolbar>
        </q-header>

        <q-drawer v-model="leftDrawerOpen" class="q-mr-lg" elevated side="left">
            <!-- drawer content -->
            <q-scroll-area
                style="
                    height: calc(100% - 150px);
                    margin-top: 150px;
                    border-right: 1px solid #ddd;
                "
            >
                <q-list padding>
                    <template
                        v-for="(menuItem, index) in menuList"
                        :key="index"
                    >
                        <q-expansion-item
                            v-if="menuItem.children"
                            :color="menuItem.color"
                            :icon="menuItem.icon"
                            :label="menuItem.label"
                            expand-separator
                        >
                            <q-card>
                                <q-card-section>
                                    <template
                                        v-for="(
                                            menuItem, childIndex
                                        ) in menuItem.children"
                                        :key="childIndex"
                                    >
                                        <q-item
                                            v-ripple
                                            :active="
                                                menuItem.label === 'Admin Stuff'
                                            "
                                            :href="menuItem.link"
                                            :to="menuItem.link"
                                            clickable
                                        >
                                            <q-item-section
                                                :avatar="!!menuItem.icon"
                                            >
                                                <q-icon :name="menuItem.icon" />
                                            </q-item-section>
                                            <q-item-section>
                                                {{ menuItem.label }}
                                            </q-item-section>
                                        </q-item>
                                        <q-separator
                                            v-if="menuItem.separator"
                                            :key="`sep${childIndex}`"
                                        />
                                    </template>
                                </q-card-section>
                            </q-card>
                        </q-expansion-item>
                        <q-item
                            v-else
                            v-ripple
                            :active="menuItem.label === 'Outbox'"
                            :href="menuItem.link"
                            :to="menuItem.link"
                            clickable
                        >
                            <q-item-section :avatar="!!menuItem.icon">
                                <q-icon :name="menuItem.icon" />
                            </q-item-section>
                            <q-item-section>
                                {{ menuItem.label }}
                            </q-item-section>
                        </q-item>
                        <q-separator
                            v-if="menuItem.separator"
                            :key="'sep' + index"
                        />
                    </template>
                </q-list>
            </q-scroll-area>
            <q-img
                class="absolute-top"
                src="https://cdn.quasar.dev/img/material.png"
                style="height: 150px"
            >
                <div class="absolute-bottom bg-transparent">
                    <q-avatar class="q-mb-sm" size="56px">
                        <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
                    </q-avatar>
                    <div class="text-weight-bold">{{ usersName }}</div>
                    <div>@ {{ usersEmail }}</div>
                </div>
            </q-img>
        </q-drawer>

        ++11
        <q-drawer
            v-model="rightDrawerOpen"
            bordered
            class="q-pa-sm"
            overlay
            side="right"
        >
            <!-- drawer content -->
            <h3 class="text-center">User Settings</h3>
            <q-separator />
            <div class="text-center">
                <Button class="q-ma-sm" @click="handleToggleDark"
                    >Toggle Dark
                </Button>
            </div>
            <q-separator />
        </q-drawer>
        ++22

        <q-page-container>
            <q-page padding>
                <slot />

                <!-- place QPageScroller at end of page -->
                <q-page-scroller
                    :offset="[18, 18]"
                    :scroll-offset="150"
                    position="bottom-right"
                >
                    <q-btn color="accent" fab icon="keyboard_arrow_up" />
                </q-page-scroller>
            </q-page>
        </q-page-container>

        <q-footer class="bg-grey-8 text-white q-py-sm" elevated>
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar v-if="tenantLogo">
                        <img :src="tenantLogo" />
                    </q-avatar>
                    <div>{{ $page.props.tenant_name ?? 'Ed Driving' }}</div>
                </q-toolbar-title>
            </q-toolbar>
        </q-footer>
    </q-layout>
</template>
<script lang="ts">
export default {
    name: 'Default',
};
</script>
<script lang="ts" setup>
import { NavProps } from '@/types/page';
import auth from '@/utils/helpers/auth';
import { usePage } from '@inertiajs/inertia-vue3';
import { useQuasar } from 'quasar';
import { computed, withDefaults } from 'vue';
import { TenantModel } from '@/utils/types/extended-models';
import useGlobal from '@/utils/useGlobal';
import { ref } from 'vue';
import { settings } from '../../utils/helpers/browser';

const page = usePage();
const quasar = useQuasar();

interface Props {
    className?: string;
    auth_check?: {
        check: boolean;
    };
    errors?: {};
    tenant?: TenantModel;
}

const props = withDefaults(defineProps<Props>(), {
    className: '',
});

const { title, breadcrumbs } = useGlobal();

const leftDrawerOpen = ref(true);
const rightDrawerOpen = ref(false);

const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value;
};

const toggleRightDrawer = () => {
    rightDrawerOpen.value = !rightDrawerOpen.value;
};

const adminStuff: NavProps[] = [
    {
        label: 'Appointment Types',
        link: '/appointment_types',
        icon: 'fa-solid fa-calendar-check',
    },
    {
        label: 'Cars',
        link: '/cars',
        icon: 'fa-solid fa-car',
    },
    {
        label: 'Courses',
        link: '/courses',
        icon: 'fa-solid fa-signs-post',
    },
    {
        label: 'Instructors',
        link: '/instructors',
        icon: 'fa-solid fa-users',
    },
    {
        label: 'Schools',
        link: '/schools',
        icon: 'fa-solid fa-school',
    },
    {
        label: 'Students',
        link: '/students',
        icon: 'fa-solid fa-graduation-cap',
    },
    {
        label: 'Student Types',
        link: '/student_types',
        icon: 'fa-solid fa-graduation-cap',
    },
    {
        label: 'Special Events',
        link: '/special_events',
        icon: 'fa-solid fa-calendar-check',
    },
    {
        label: 'My Tenant',
        link: '/tenant',
        icon: 'fa-solid fa-globe',
    },
    {
        label: 'Test Locations',
        link: '/test_locations',
        icon: 'fa-solid fa-map-pin',
    },
    {
        label: 'Time Off',
        link: '/time_off',
        icon: 'fa-solid fa-clock',
    },
    {
        label: 'Users',
        link: '/users',
        icon: 'fa-solid fa-users',
    },
];

const menuList = [
    {
        label: 'Dashboard',
        icon: 'fa-solid fa-magnifying-glass',
        link: '/',
    },
    {
        label: 'Search Students',
        icon: 'fa-solid fa-magnifying-glass',
        separator: true,
        link: '/search/student',
    },
    {
        label: 'Admin Stuff',
        children: adminStuff,
        color: 'warning',
    },
];

const usersName = auth('name');
const usersEmail = auth('email');

const tenantStyles = computed<string>(() => {
    const styles: string[] = [];

    const pageProps = page.props.value as any;

    const { bgcolor = '', fgcolor = undefined } = pageProps?.tenant || {};

    if (bgcolor) {
        styles.push(`background: ${bgcolor} !important`);
    }

    if (fgcolor) {
        styles.push('color: ' + fgcolor + ' !important');
    }

    return styles.join(';');
});

const handleToggleDark = () => {
    const isDarkActive = quasar.dark.isActive;
    const newDarkMode = !isDarkActive;

    quasar.dark.set(newDarkMode);

    settings('dark-mode', newDarkMode);
};

const tenantLogo = computed(() => {
    const { logo } = (page.props.value?.tenant || {}) as any;
    return logo;
});
</script>
