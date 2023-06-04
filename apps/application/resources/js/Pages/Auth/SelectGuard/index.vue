<template>
    <div class="row justify-content-center align-content-center vh-100 vw-100">
        <h2 class="text-center mt-3">
            {{ $page.props.tenant.name }}
        </h2>
    </div>
    <div class="row justify-center">
        <div class="col-grow">
            <div
                class="flex wrap justify-content-center align-content-center q-mb-md"
                style="gap: 10px"
            >
                <q-card
                    v-for="guard in guards"
                    :key="`login-${guard.id}`"
                    class="login-card my-card"
                >
                    <q-card-section>
                        <div class="text-h6">Our Changing Planet</div>
                        <div class="text-subtitle2">by John Doe</div>
                    </q-card-section>

                    <q-card-section>
                        {{ guard.label }}

                        <div>
                            <img
                                v-if="guard.img"
                                :alt="`Missing image for '${guard.label}'`"
                                :src="guard.img"
                                class="login-img"
                            />
                        </div>
                    </q-card-section>

                    <q-separator dark />

                    <q-card-actions>
                        <q-btn :href="`/login/${guard.name}`" flat>
                            Login
                        </q-btn>
                    </q-card-actions>
                </q-card>
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import BlankLayout from '@/Layouts/Blank';

export default {
    layout: (h: any, page: any) => {
        return h(BlankLayout, () => page);
    },
};
</script>
<script lang="ts" setup>
type GuardObj = {
    id: number;
    name: 'instructors' | 'student';
    label: string;
    img?: string;
};

const guards: GuardObj[] = [
    {
        id: 1,
        name: 'instructors',
        label: 'Instructor',
        img: '/img/login/instructor.jpg',
    },
    {
        id: 2,
        name: 'student',
        label: 'Student',
        img: '/img/login/student.jpeg',
    },
];
</script>
<style lang="scss" scoped>
.login-card {
    width: 385px;

    .card {
        & > .card-body {
            height: 340px;
        }
    }

    &:hover {
        .card {
            -webkit-filter: brightness(90%);
        }
    }
}

.login-img {
    height: 280px;
    width: 100%;
}
</style>
