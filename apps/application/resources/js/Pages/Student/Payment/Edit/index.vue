<template>
    <CtxForm
        :action="`/students/${student.id}/payments`"
        :form="payment"
        add-submit-button
        method="post"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import { StudentModel } from '@/utils/types/extended-models';
import useGlobal from '@/utils/useGlobal';
import Form from '../Form/index.vue';

defineProps<{
    student: StudentModel;
    payment: App.Models.Payments;
}>();
const { setTitle } = useGlobal();
setTitle('Student Payment Edit');
</script>
