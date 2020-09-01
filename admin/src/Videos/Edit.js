import React from 'react';
import { Edit, SimpleForm, TextInput, required, ReferenceInput, SelectInput } from 'react-admin';

const VideoTitle = ({ record }) =>
    record ? `Edition de ${record.id}` : null;

export const VideoEdit = (props) => {
    return (
        <Edit title={<VideoTitle />} {...props}>
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
        </Edit>
    );
};
