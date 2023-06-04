<template>
    <div class="col-lg-6 col-xl-4">
        <div class="card mb-5 mb-xl-0">
            <div class="card-body">
                <div
                    class="small text-uppercase fw-bold text-muted"
                    v-text="planLabel"
                />
                <div class="q-mb-md">
                    <span class="display-4 fw-bold">{{ price }}</span>
                    <span class="text-muted">/ mo.</span>
                </div>
                <ul class="list-unstyled mb-4 plan-perks">
                    <li
                        v-for="perk in perks"
                        :key="perk.label"
                        :class="{ 'text-muted': !perk.active }"
                        class="mb-2"
                    >
                        <Icon
                            v-if="perk.active"
                            icon-class="fas"
                            name="check"
                        />
                        <Icon v-else icon-class="fas" name="times" />
                        <strong>{{ perk.label }}</strong>
                    </li>
                </ul>
                <div class="d-grid">
                    <app-link
                        :href="`/register/basic-info/${planName}`"
                        class="btn btn-outline-primary pt-2"
                    >
                        Choose plan
                    </app-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
type Perk = {
    label: string;
    active: boolean;
};

defineProps<{
    perks: Perk[];
    price: string;
    planName: string;
    planLabel: string;
}>();
</script>
<style lang="scss" scoped>
.plan-perks {
    li > i {
        width: 20px;
    }
}
</style>
