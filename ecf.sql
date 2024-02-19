CREATE USER 'ECF'@'localhost' IDENTIFIED BY 'ECFecfECF';
CREATE DATABASE IF NOT EXISTS `ecf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecf`;
CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `medecin` int(11) NOT NULL,
  `patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `medecin` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `matricule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `liste_medicament` text NOT NULL,
  `posologie` text NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `sejour` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `motif` text NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `medecin` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `entre` tinyint(1) NOT NULL DEFAULT 0,
  `sortie` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `user` (`id`, `email`, `password`, `id_user`) VALUES
(1, 'admin@admin.com', '$2y$10$WiLOkc40SuL7dVXebh5TYOeBQCb8kJIHviF.MJh6TxmC4wi4WVQn2', NULL);
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medecin_avis` (`medecin`),
  ADD KEY `id_patient_avis` (`patient`);
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_patient_prescription` (`patient`);
ALTER TABLE `sejour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medecin` (`medecin`),
  ADD KEY `id_patient` (`patient`);
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_user`);
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `medecin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `sejour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `avis`
  ADD CONSTRAINT `id_medecin_avis` FOREIGN KEY (`medecin`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `id_patient_avis` FOREIGN KEY (`patient`) REFERENCES `utilisateur` (`id`);
ALTER TABLE `prescription`
  ADD CONSTRAINT `id_patient_prescription` FOREIGN KEY (`patient`) REFERENCES `utilisateur` (`id`);
ALTER TABLE `sejour`
  ADD CONSTRAINT `id_medecin` FOREIGN KEY (`medecin`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `id_patient` FOREIGN KEY (`patient`) REFERENCES `utilisateur` (`id`);
ALTER TABLE `user`
  ADD CONSTRAINT `id_utilisateur` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`);
COMMIT;
