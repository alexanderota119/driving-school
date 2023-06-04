<template>
    <q-page>
        <CtxForm
            :action="`/users/${user.id}`"
            :form="user"
            add-submit-button
            method="put"
        >
            <Form />
        </CtxForm>
    </q-page>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

const { user } = defineProps<{
    user: App.Models.User;
}>();
console.log('111', { user });
</script>
