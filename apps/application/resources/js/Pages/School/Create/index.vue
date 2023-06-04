<template>
    <CtxForm action="/schools" add-submit-button method="post">
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import useGlobal from '@/utils/useGlobal';
import Form from '../Form/index.vue';

const { addBreadcrumb } = useGlobal();
addBreadcrumb({ title: 'Schools', href: '/schools' });
</script>
