<template>
    <div>
        <div>
            <jet-section-border />

            <jet-form-section @submitted="updateTeamDashboard">
                <template #title>
                    Team Dashboard
                </template>

                <template #description>
                    The team's dashboard information.
                </template>

                <template #form>
                    <!-- Team Dashboard Information -->
                    <div class="col-span-6">
                        <jet-label for="dashboard" value="Team Dashboard" />

                        <jet-textarea   id="dashboard"
                                        class="mt-1 block h-32 w-full"
                                        v-model="form.dashboard"
                                        :disabled="! permissions.canUpdateTeam" />

                        <jet-input-error :message="form.errors.dashboard" class="mt-2" />
                    </div>
                </template>

                <template #actions v-if="permissions.canUpdateTeam">
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </jet-button>
                </template>
            </jet-form-section>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetTextarea from '@/Jetstream/Textarea'
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetTextarea,
            JetSectionBorder,
        },

        props: ['team', 'permissions'],

        data() {
            return {
                form: this.$inertia.form({
                    dashboard: this.team.dashboard,
                })
            }
        },

        methods: {
            updateTeamDashboard() {
                this.form.put(route('team-dashboard.update', this.team), {
                    errorBag: 'updateTeamDashboard',
                    preserveScroll: true
                });
            },
        },
    })
</script>
