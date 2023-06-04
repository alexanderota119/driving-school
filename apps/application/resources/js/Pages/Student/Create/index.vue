<template>
    <CtxForm
        :breadcrumb="breadcrumb"
        action="/students"
        add-submit-button
        breadcrumb-href="/students"
        method="post"
        title="Student"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import useGlobal from '@/utils/useGlobal';
import Form from '../Form/index.vue';
//

const { setTitle } = useGlobal();
setTitle('Student Create');

const breadcrumb = [
    {
        title: 'Create',
    },
];
</script>
