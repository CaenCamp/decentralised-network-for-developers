import React from 'react';
import { 
    BooleanInput,
    Create,
    DateTimeInput,
    ReferenceInput,
    SelectArrayInput,
    SelectInput,
    SimpleForm,
    TextInput,
    ReferenceArrayInput,
    required,
} from 'react-admin';

const eventDefaultValue = {
    eventStatus: 'EventScheduled',
    eventAttendanceMode: 'OnlineEventAttendanceMode',
    inLanguage: 'fr',
    isAccessibleForFree: true,
};

export const EventCreate = (props) => (
    <Create {...props} title="Création d'un évènement">
        <SimpleForm initialValues={eventDefaultValue}>
            <TextInput
                fullWidth
                label="Nom de l'évènement"
                source="name"
                validate={required()}
            />
           <TextInput
                fullWidth
                label="Url de l'image"
                source="image"
            />
            <TextInput
                fullWidth
                label="Url de la conférence si en ligne"
                source="url"
            />
            <TextInput
                fullWidth
                multiline
                label="Résumé"
                source="disambiguatingDescription"
                validate={required()}
            />
            <TextInput
                fullWidth
                multiline
                label="Présentation"
                source="description"
            />
            <SelectInput source="eventStatus" label="Statut" choices={[
                { id: 'EventScheduled', name: 'Programmé' },
                { id: 'EventCancelled', name: 'Annulé' },
                { id: 'EventMovedOnline', name: 'Déplacé en ligne' },
                { id: 'EventPostponed', name: 'Reporté à plus tard' },
                { id: 'EventRescheduled', name: 'reprogrammé' },
            ]} />
            <SelectInput source="eventAttendanceMode" label="Type" choices={[
                { id: 'OnlineEventAttendanceMode', name: 'En présentiel' },
                { id: 'OfflineEventAttendanceMode', name: 'En ligne' },
                { id: 'MixedEventAttendanceMode', name: 'Mixte (IRL retransmit en ligne)' },
            ]} />
            <SelectInput source="inLanguage" label="Langue" choices={[
                { id: 'fr', name: 'Français' },
                { id: 'en', name: 'Anglais' },
                { id: 'de', name: 'Allemand' },
            ]} />
            <BooleanInput label="Gratuit" source="isAccessibleForFree" />
            <DateTimeInput
                fullWidth
                label="Ouverture des portes"
                source="doorTime"
            />
            <DateTimeInput
                fullWidth
                label="Début"
                source="startDate"
            />
            <DateTimeInput
                fullWidth
                label="Fin"
                source="endDate"
            />
            <ReferenceInput
                label="Lieu"
                source="location"
                reference="places"
                validate={required()}
            >
                <SelectInput optionText="name" />
            </ReferenceInput>
            <ReferenceInput
                label="Organisateur"
                source="organizer"
                reference="organizations"
                validate={required()}
            >
                <SelectInput optionText="name" />
            </ReferenceInput>
            <ReferenceInput
                label="Sponsor"
                source="sponsor"
                reference="organizations"
                validate={required()}
            >
                <SelectInput optionText="name" />
            </ReferenceInput>
            <ReferenceArrayInput label="Les talks" source="worksPerformed" reference="creative_works">
                <SelectArrayInput optionText="name" />
            </ReferenceArrayInput>
        </SimpleForm>
    </Create>
);
