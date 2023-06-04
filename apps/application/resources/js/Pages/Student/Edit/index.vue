<template>
    <CtxForm
        :action="`/students/${student.id}`"
        :form="student"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import useGlobal from '@/utils/useGlobal';
import Form from '../Form/index.vue';

const { student } = defineProps<{
    student: App.Models.Student;
}>();

const { setTitle, addBreadcrumb } = useGlobal();
setTitle('Student Edit');
addBreadcrumb({ title: 'Student', href: '/students' });
addBreadcrumb({ title: `${student.name}` });
</script>
