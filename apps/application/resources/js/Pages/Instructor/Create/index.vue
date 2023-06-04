<template>
    <CtxForm :form="instructor" action="/instructors" add-submit-button>
        ++
        <Form />
        --
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    instructor: App.Models.Instructor;
}>();
</script>
