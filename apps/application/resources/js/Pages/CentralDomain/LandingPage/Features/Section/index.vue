<template>
    <section id="features" class="py-5 border-bottom">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <feature-tile
                    v-for="feature in features"
                    :key="`feature-${feature.title}`"
                    :action="feature.action"
                    :message="feature.message"
                    :title="feature.title"
                />
            </div>
        </div>
    </section>
</template>
<script lang="ts" setup>
import FeatureTile from '../Tile';

defineProps<{}>();
//

const features = [
    {
        title: 'Featured title',
        message:
            "Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.",
        action: '#',
    },
    {
        title: 'Featured title',
        message:
            "Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.",
        action: '#',
    },
    {
        title: 'Featured title',
        message:
            "Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.",
        action: '#',
    },
];
</script>
