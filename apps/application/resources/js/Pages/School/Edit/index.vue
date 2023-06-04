<!--suppress ALL -->
<template>
    <CtxForm
        :action="`/schools/${school.id}`"
        :form="school"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import useGlobal from '@/utils/useGlobal';
import Form from '../Form/index.vue';

const { school } = defineProps<{
    school: App.Models.School;
}>();
const { addBreadcrumb } = useGlobal();
addBreadcrumb({ title: 'Schools', href: '/schools' });
addBreadcrumb({ title: `${school.name}` });
</script>
