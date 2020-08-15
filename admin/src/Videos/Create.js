import React from 'react';
import { Create, SimpleForm, TextInput, ReferenceInput, SelectInput, required } from 'react-admin';

export const VideoCreate = (props) => (
    <Create {...props} title="Ajout d'une vidéo">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Description"
                source="abstract"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Url de la vidéo"
                source="contentUrl"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Url embeded"
                source="embedUrl"
                validate={required()}
            />
            <ReferenceInput label="Talk enregistré" source="encodesCreativeWork" reference="creative_works">
                <SelectInput optionText="name" />
            </ReferenceInput>
            <ReferenceInput label="Enregistré au meetup" source="recordedAt" reference="events">
                <SelectInput optionText="name" />
            </ReferenceInput>
        </SimpleForm>
    </Create>
);
