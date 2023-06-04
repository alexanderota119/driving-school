<template>
    <ctx-form
        :form="{ search }"
        action="/search/student"
        add-submit-button
        method="get"
        no-title
    >
        <ctx-input label="Search" name="search" />
    </ctx-form>
    <StudentTileList :list="results" />
</template>
<script lang="ts" setup>
import { StudentTileList } from '@/Components/index';
import { StudentModel } from '@/utils/types/extended-models';
import useGlobal from '@/utils/useGlobal';

defineProps<{
    results: StudentModel[];
    search: string;
}>();

const { setTitle, addBreadcrumb } = useGlobal();
setTitle('Student Search');
addBreadcrumb({ title: 'Student', href: '/students' });
addBreadcrumb({ title: 'Search' });
</script>
