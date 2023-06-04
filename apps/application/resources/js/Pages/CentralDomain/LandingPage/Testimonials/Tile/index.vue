<template>
    <div class="card mb-4">
        <div class="card-body flex">
            <div class="flex-shrink-0">
                <icon icon-class="fas" name="message" size="2x" />
            </div>
            <div class="ms-4">
                <p class="mb-1" v-text="message" />
                <div class="small text-muted">- {{ name }}, {{ business }}</div>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { Testimonial } from '@/types/testimonials';

interface Props extends Testimonial {
    name: string;
    message: string;
    business: string;
}

defineProps<Props>();
//
</script>
