<template>
    <div class="row">
        <div class="col-md-8">
            <ctx-input label="Amount" name="amount" prefix="$" type="number" />
            <api-ctx-select
                label="Payment Type"
                model="payment_types"
                name="payment_type_id"
            />
            <api-ctx-select label="Course" model="courses" name="course_id" />
        </div>
        <div class="col-grow">
            <CtxNotes />
        </div>
    </div>
</template>
<script lang="ts" setup>
import { ApiCtxSelect, CtxNotes } from '@/Components/index';
//
</script>
