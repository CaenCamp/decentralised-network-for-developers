import React from 'react';
import { Edit, SimpleForm, TextInput, required } from 'react-admin';

const EventTitle = ({ record }) =>
    record ? `Edition de ${record.name}` : null;

export const EventEdit = (props) => {
    return (
        <Edit title={<EventTitle />} {...props}>
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
                    source="logo"
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
            </SimpleForm>
        </Edit>
    );
};
