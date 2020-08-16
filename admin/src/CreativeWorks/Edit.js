import React from 'react';
import { Edit,
    Button,
    TextInput,
    required,
    ReferenceInput,
    SelectInput,
    ReferenceArrayInput,
    SelectArrayInput,
    TabbedForm,
    FormTab,
    Link,
    ReferenceManyField,
    Datagrid,
    TextField,
    EditButton,
    ReferenceField,
    UrlField,
    SingleFieldList,
    ChipField,
} from 'react-admin';
import ChatBubbleIcon from "@material-ui/icons/ChatBubble";

const AddNewMaterialButton = ({ record }) => (
  <Button
    component={Link}
    to={{
      pathname: "/creative_work_materials/create",
      state: { encodesCreativeWork: record.originId },
    }}
    label="Ajouter un support"
  >
    <ChatBubbleIcon />
  </Button>
);
const AddNewVideoButton = ({ record }) => (
  <Button
    component={Link}
    to={{
      pathname: "/video_objects/create",
      state: { encodesCreativeWork: record.id },
    }}
    label="Ajouter une vidéo"
  >
    <ChatBubbleIcon />
  </Button>
);

const CreativeWorkTitle = ({ record }) =>
    record ? `Edition de ${record.name}` : null;

export const CreativeWorkEdit = (props) => {
    return (
        <Edit title={<CreativeWorkTitle />} {...props}>
            <TabbedForm>
                <FormTab label="La présentation">
                    <TextInput
                        fullWidth
                        label="Nom"
                        source="name"
                        validate={required()}
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
                        source="abstract"
                    />
                    <ReferenceInput
                        label="Type de talk"
                        source="learningResourceType"
                        reference="learning_resource_types"
                        filter={{ typeFor: 'creativeWork' }}
                        validate={required()}
                    >
                        <SelectInput optionText="name" />
                    </ReferenceInput>
                    <TextInput
                        fullWidth
                        label="Url de l'image"
                        source="image"
                    />
                    <TextInput
                        fullWidth
                        label="Langue"
                        source="inLanguage"
                    />
                    <ReferenceArrayInput label="Mainteneurs" source="maintainers" reference="people">
                        <SelectArrayInput optionText="name" />
                    </ReferenceArrayInput>
                </FormTab>
                <FormTab label="Les supports">
                    <ReferenceManyField
                        addLabel={false}
                        reference="creative_work_materials"
                        target="encodesCreativeWork"
                        source="originId"
                    >
                        <Datagrid fullWidth>
                            <TextField source="abstract" label="Description" fullWidth/>
                            <ReferenceField label="Type de support" source="learningResourceType" reference="learning_resource_types">
                                <TextField source="name" />
                            </ReferenceField>
                            <UrlField source="contentUrl" label="Lien" />
                            <TextField source="abstract" />
                            <EditButton />
                        </Datagrid>
                    </ReferenceManyField>
                    <AddNewMaterialButton />
                </FormTab>
                <FormTab label="Les Vidéos">
                    <ReferenceManyField
                        addLabel={false}
                        reference="video_objects"
                        target="encodesCreativeWork"
                        source="originId"
                    >
                        <Datagrid fullWidth>
                            <TextField source="abstract" label="Description" fullWidth/>
                            <UrlField source="contentUrl" label="Lien" />
                            <TextField source="abstract" />
                            <EditButton />
                        </Datagrid>
                    </ReferenceManyField>
                    <AddNewVideoButton />
                </FormTab>
            </TabbedForm>
        </Edit>
    );
};
