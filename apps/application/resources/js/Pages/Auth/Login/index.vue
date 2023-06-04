<template>
    <div class="flex wrap justify-content align-center vh-100 vw-100">
        <CtxForm :action="`/login/${url}`" class="login-form" method="post">
            <q-card class="no-padding">
                <q-card-section>
                    Login as {{ url.replace(/s$/, '') }}
                </q-card-section>
                <q-card-section>
                    <ctx-input
                        autofocus
                        label="Email"
                        name="email"
                        required
                        type="email"
                    />

                    <ctx-input
                        label="Password"
                        name="password"
                        required
                        type="password"
                    />
                </q-card-section>
                <q-card-section class="row gap-3">
                    <ed-button type="submit">Submit</ed-button>
                    <ed-button href="/login" variant="warning">Back</ed-button>
                </q-card-section>
            </q-card>
        </CtxForm>
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
defineProps<{
    url: string;
    email: string;
    remember_me?: boolean;
    password: string;
}>();
</script>
<style lang="scss" scoped>
.login-form {
    width: 300px;
}
</style>
