import React from 'react';
import { 
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

/*
    private $name;
    private $description;
    private $disambiguatingDescription;
    private $image;
    private $url;
private $eventStatus;
private $eventAttendanceMode;
private $inLanguage;
private $isAccessibleForFree;
    private $doorTime;
    private $startDate;
    private $endDate;
private $location;
private $organizer;
private $sponsor;
private $recordedIn;
private $worksPerformed;
*/

export const EventCreate = (props) => (
    <Create {...props} title="Création d'un évènement">
        <SimpleForm>
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
