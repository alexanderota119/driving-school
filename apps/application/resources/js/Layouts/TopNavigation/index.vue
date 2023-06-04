<template>
    <b-navbar fixed="top" toggleable="lg" type="dark" variant="info">
        <b-navbar-brand class="navbar-brand" href="/">
            {{ $page.props.tenant_name ?? 'Ed Driving' }}
        </b-navbar-brand>

        <b-navbar-toggle target="navbarNav" />

        <b-collapse id="navbarNav" is-nav>
            <b-navbar-nav>
                <NavItem :active="$page.url === '/home'" href="/home"
                    >Home
                </NavItem>
                <NavItem
                    :active="$page.url === '/search/student'"
                    href="/search/student"
                    >Search Students
                </NavItem>
                <NavItem
                    :active="$page.url === '/about'"
                    class="d-none"
                    href="/about"
                    >About
                </NavItem>
            </b-navbar-nav>

            <b-navbar-nav class="ms-auto">
                <b-nav-item-dropdown
                    :class="{ active: adminStuffIsActive($page.url) }"
                    class="bg-dark pb-0"
                    right
                >
                    <template v-slot:button-content>
                        <span class="text-light"> Admin Stuff </span>
                    </template>
                    <NavItemDropdown
                        v-for="link in adminStuff"
                        :key="link.link"
                        :active="$page.component.startsWith('Home')"
                        :href="`/${link.link}`"
                    >
                        {{ link.label }}
                    </NavItemDropdown>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown
                    :class="{ active: userStuffIsActive($page.url) }"
                    class="ms-3 text-light"
                    right
                >
                    <template v-slot:button-content>
                        <img
                            v-if="avatar"
                            :src="avatar"
                            alt="ME"
                            class="img-fluid rounded-circle"
                            style="max-height: 50px"
                        />
                        <span class="text-light ms-3">
                            {{ authedUserName }}
                        </span>
                    </template>
                    <NavItemDropdown href="/profile">Profile</NavItemDropdown>
                    <b-dropdown-item
                        v-if="is_instructor"
                        prefetch
                        to="/profile/timeoff"
                        >Time off Requests
                    </b-dropdown-item>
                    <b-dropdown-divider />
                    <NavItemDropdown v-if="false" href="#my-tenant"
                        >My Tenant
                    </NavItemDropdown>
                    <b-dropdown-item v-if="auth_check" href="/logout"
                        >Logout
                    </b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
    <div class="mt-5"></div>
</template>
<script lang="ts" setup>
import { NavProps } from '@/types/page';
import auth from '@/utils/helpers/auth';
import { computed, withDefaults } from 'vue';
import NavItem from './NavItem';
import NavItemDropdown from './NavItemDropdown';

interface Props {
    auth_check?: {
        check: boolean;
    };
}

withDefaults(defineProps<Props>(), {
    auth_check: {
        check: false,
    },
});

const adminStuff: NavProps[] = [
    {
        label: 'Appointment Types',
        link: 'appointment_types',
    },
    {
        label: 'Cars',
        link: 'cars',
    },
    {
        label: 'Courses',
        link: 'courses',
    },
    {
        label: 'Instructors',
        link: 'instructors',
    },
    {
        label: 'Schools',
        link: 'schools',
    },
    {
        label: 'Students',
        link: 'students',
    },
    {
        label: 'Student Types',
        link: 'student_types',
    },
    {
        label: 'Special Events',
        link: 'special_events',
    },
    {
        label: 'Tenants',
        link: 'tenants',
    },
    {
        label: 'Test Locations',
        link: 'test_locations',
    },
    {
        label: 'Time Off',
        link: 'time_off',
    },
    {
        label: 'Users',
        link: 'users',
    },
];

const adminStuffIsActive = (url: string): boolean => {
    const found: number = adminStuff.findIndex(({ link }) =>
        url.includes(`/${link}`),
    );

    return found >= 0;
};

const userStuffIsActive = (url: string): boolean => {
    const userRoutes = [{ link: '/profile' }, { link: '/profile/timeoff' }];

    const found: number = userRoutes.findIndex(({ link }) => url === link);

    return found >= 0;
};

const authedUserName = computed(() => {
    return auth('name', 'User');
});

const avatar = computed(() => {
    return auth('avatar', false);
});

const is_instructor = computed<boolean>(() => {
    return auth('type', false) === 'instructor';
});
</script>
<style lang="scss" scoped>
.btn-group {
    display: block;

    .dropdown-menu {
        position: static;
        float: none;
    }
}
</style>
