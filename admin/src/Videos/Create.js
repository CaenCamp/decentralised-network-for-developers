import React from 'react';
import { Create, SimpleForm, TextInput, required } from 'react-admin';

export const VideoCreate = (props) => (
    <Create {...props} title="Ajout d'une vidéo">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Description"
                source="abstract"
                validate={required()}
            />
        </SimpleForm>
    </Create>
);
