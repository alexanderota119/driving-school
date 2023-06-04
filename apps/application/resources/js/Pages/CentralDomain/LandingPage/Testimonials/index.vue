<template>
    <testimonial-tile
        v-for="testimonial in testimonials"
        :key="`testimonial.${testimonial.busienss}.${testimonial.name}`"
        :business="testimonial.business"
        :message="testimonial.message"
        :name="testimonial.name"
    />
</template>
<script lang="ts" setup>
import { Testimonial } from '@/types/testimonials';
import TestimonialTile from './Tile';

defineProps<{}>();
//

const testimonials: Testimonial[] = [
    {
        name: 'Ben Dover',
        message:
            'Thank you for putting together such a great product. We loved working with you and the whole team, and we will be recommending you to others!',
        business: 'Driving Company INC',
    },
    {
        name: 'Mike Oxbig',
        message:
            'The whole team was a huge help with putting things together for our company and brand. We will be hiring them again in the near future for additional work!',
        business: 'Another Company LLC',
    },
];
</script>
